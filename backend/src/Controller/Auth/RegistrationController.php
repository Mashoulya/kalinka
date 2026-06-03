<?php

namespace App\Controller\Auth;

use App\Entity\User;
use App\Enum\Gender;
use App\Repository\UserRepository;
use App\Service\EmailVerifier;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class RegistrationController extends AbstractController
{
    #[Route('/api/register', name: 'api_register', methods: ['POST'])]
    public function register(
        Request $request,
        UserPasswordHasherInterface $passwordHasher,
        EntityManagerInterface $entityManager,
        ValidatorInterface $validator,
        EmailVerifier $emailVerifier,
        UserRepository $userRepository
    ): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        if (!is_array($data)) {
            return new JsonResponse([
                'message' => 'Corps JSON invalide.',
            ], JsonResponse::HTTP_BAD_REQUEST);
        }

        $email = trim((string) ($data['email'] ?? ''));
        $phone = trim((string) ($data['phone'] ?? ''));

        if ($userRepository->findOneBy(['email' => $email]) instanceof User) {
            return new JsonResponse([
                'message' => 'Email already in use.',
            ], JsonResponse::HTTP_CONFLICT);
        }

        if ($userRepository->findOneBy(['phone' => $phone]) instanceof User) {
            return new JsonResponse([
                'message' => 'Téléphone déjà utilisé.',
            ], JsonResponse::HTTP_CONFLICT);
        }

        $gender = Gender::tryFrom((string) ($data['title'] ?? ''));
        if ($gender === null) {
            return new JsonResponse([
                'message' => 'Titre invalide. Valeurs autorisées : Mr, Mrs, Other.',
            ], JsonResponse::HTTP_BAD_REQUEST);
        }

        $birthDateInput = (string) ($data['birthDate'] ?? '');
        $birthDate = \DateTimeImmutable::createFromFormat('!Y-m-d', $birthDateInput);
        if ($birthDate === false || $birthDate->format('Y-m-d') !== $birthDateInput) {
            return new JsonResponse([
                'message' => 'Date de naissance invalide. Format attendu : YYYY-MM-DD.',
            ], JsonResponse::HTTP_BAD_REQUEST);
        }

        $user = new User();
        $user->setTitle($gender);
        $user->setLastName(trim((string) ($data['lastName'] ?? '')));
        $user->setFirstName(trim((string) ($data['firstName'] ?? '')));
        $user->setBirthDate($birthDate);
        $user->setPostalCode(trim((string) ($data['postalCode'] ?? '')));
        $user->setCity(trim((string) ($data['city'] ?? '')));
        $user->setPhone($phone);
        $user->setEmail($email);
        $password = (string) ($data['password'] ?? '');
        $user->setPassword($passwordHasher->hashPassword($user, $password));

        $user->setRoles(['ROLE_USER']);
        $user->setCreatedAt(new \DateTimeImmutable());
        $user->setUpdatedAt(new \DateTimeImmutable());

        $errors = $validator->validate($user);
        if (count($errors) > 0) {
            $formattedErrors = [];
            foreach ($errors as $error) {
                $field = (string) $error->getPropertyPath();
                $formattedErrors[] = $field . ': ' . $error->getMessage();
            }

            return new JsonResponse([
                'message' => 'Validation échouée.',
                'errors' => $formattedErrors,
            ], JsonResponse::HTTP_BAD_REQUEST);
        }

        try {
            $entityManager->persist($user);
            $entityManager->flush();
        } catch (UniqueConstraintViolationException) {
            return new JsonResponse([
                'message' => 'Email ou téléphone déjà utilisé.',
            ], JsonResponse::HTTP_CONFLICT);
        }

        try {
            $emailVerifier->sendEmailConfirmation($user);

            return new JsonResponse([
                'message' => 'Utilisateur enregistré avec succès. Veuillez vérifier votre email.',
            ], JsonResponse::HTTP_CREATED);
        } catch (\Throwable) {
            // Registration is successful even if SMTP is temporarily unavailable.
            return new JsonResponse([
                'message' => 'Utilisateur enregistré avec succès, mais l\'email de vérification n\'a pas pu être envoyé pour le moment.',
            ], JsonResponse::HTTP_CREATED);
        }
    }

    #[Route('/api/verify/email', name: 'api_verify_email', methods: ['GET'])]
    public function verifyUserEmail(
        Request $request,
        UserRepository $userRepository,
        EmailVerifier $emailVerifier
    ): JsonResponse {
        $id = $request->query->getInt('id');
        if ($id <= 0) {
            return new JsonResponse(['message' => 'ID utilisateur manquant ou invalide.'], JsonResponse::HTTP_BAD_REQUEST);
        }

        $user = $userRepository->find($id);
        if (!$user instanceof User) {
            return new JsonResponse(['message' => 'Utilisateur introuvable.'], JsonResponse::HTTP_NOT_FOUND);
        }

        try {
            $emailVerifier->handleEmailConfirmation($request->getUri(), $user);
        } catch (\RuntimeException $e) {
            return new JsonResponse(['message' => $e->getMessage()], JsonResponse::HTTP_BAD_REQUEST);
        }

        return new JsonResponse(['message' => 'Email vérifié avec succès.'], JsonResponse::HTTP_OK);
    }
}
