<?php
namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class EmailVerifier
{
    public function __construct(
        private SendMailService $sendMailService,
        private EntityManagerInterface $entityManager,
        private UrlGeneratorInterface $urlGenerator,
        private string $appSecret,
        private string $fromAddress = 'no-reply@kalinka.com',
        private string $appBaseUrl = 'http://localhost'
    ) {}

    public function sendEmailConfirmation(string $verifyEmailRouteName, User $user): void
    {
        $expires = time() + 86400;
        $signature = $this->createSignature($user, $expires);

        $path = $this->urlGenerator->generate(
            $verifyEmailRouteName,
            [
                'id' => $user->getId(),
                'expires' => $expires,
                'signature' => $signature,
            ],
            UrlGeneratorInterface::ABSOLUTE_PATH
        );
        $signedUrl = rtrim($this->appBaseUrl, '/') . $path;

        $html = <<<HTML
            <p>Bienvenue sur Epicerie Kalinka.</p>
            <p>Cliquez sur le lien ci-dessous pour verifier votre adresse email :</p>
            <p><a href="{{ signedUrl }}">Verifier mon email</a></p>
            <p>Ce lien expire dans 24 heures.</p>
        HTML;

        $this->sendMailService->send(
            $this->fromAddress,
            (string) $user->getEmail(),
            'Verification de votre email',
            $html,
            ['signedUrl' => $signedUrl]
        );
    }

    public function handleEmailConfirmation(string $signedUrl, User $user): void
    {
        $query = parse_url($signedUrl, PHP_URL_QUERY);
        parse_str((string) $query, $params);

        $expires = isset($params['expires']) ? (int) $params['expires'] : 0;
        $signature = (string) ($params['signature'] ?? '');
        $id = isset($params['id']) ? (int) $params['id'] : null;

        if ($id !== $user->getId()) {
            throw new \RuntimeException('Invalid verification user.');
        }

        if ($expires < time()) {
            throw new \RuntimeException('Verification link has expired.');
        }

        $expectedSignature = $this->createSignature($user, $expires);
        if (!hash_equals($expectedSignature, $signature)) {
            throw new \RuntimeException('Invalid verification signature.');
        }

        $user->setIsVerified(true);

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    private function createSignature(User $user, int $expires): string
    {
        return hash_hmac(
            'sha256',
            sprintf('%d|%s|%d', $user->getId(), (string) $user->getEmail(), $expires),
            $this->appSecret
        );
    }
}