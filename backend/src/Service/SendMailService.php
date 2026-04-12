<?php
namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class SendMailService
{
    public function __construct(private MailerInterface $mailer) {}

    /**
     * Envoie un email HTML simple (sans Twig).
     */
    public function send(
        string $from,
        string $to,
        string $subject,
        string $html,
        array $context = []
    ): void {
        foreach ($context as $key => $value) {
            $html = str_replace(
                ['{{ ' . $key . ' }}', '{{' . $key . '}}'],
                htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8'),
                $html
            );
        }

        $email = (new Email())
            ->from($from)
            ->to($to)
            ->subject($subject)
            ->html($html)
            ->text(trim(strip_tags($html)));

        $this->mailer->send($email);
    }
}