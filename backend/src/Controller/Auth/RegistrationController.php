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

        $email = (string) ($data['email'] ?? '');
        $phone = (string) ($data['phone'] ?? '');

        if ($userRepository->findOneBy(['email' => $email]) instanceof User) {
            return new JsonResponse([
                'error' => 'Email already in use.',
            ], JsonResponse::HTTP_CONFLICT);
        }

        if ($userRepository->findOneBy(['phone' => $phone]) instanceof User) {
            return new JsonResponse([
                'error' => 'Phone already in use.',
            ], JsonResponse::HTTP_CONFLICT);
        }

        $gender = Gender::tryFrom((string) ($data['title'] ?? ''));
        if ($gender === null) {
            return new JsonResponse([
                'error' => 'Invalid title. Allowed values: Mr, Mrs, Other.',
            ], JsonResponse::HTTP_BAD_REQUEST);
        }

        $birthDateInput = (string) ($data['birthDate'] ?? '');
        $birthDate = \DateTimeImmutable::createFromFormat('!Y-m-d', $birthDateInput);
        if ($birthDate === false || $birthDate->format('Y-m-d') !== $birthDateInput) {
            return new JsonResponse([
                'error' => 'Invalid birthDate. Expected format: YYYY-MM-DD.',
            ], JsonResponse::HTTP_BAD_REQUEST);
        }

        $user = new User();
        $user->setTitle($gender);
        $user->setLastName($data['lastName']);
        $user->setFirstName($data['firstName']);
        $user->setBirthDate($birthDate);
        $user->setPostalCode($data['postalCode']);
        $user->setCity($data['city']);  
        $user->setPhone($phone);
        $user->setEmail($email);
        $user->setPassword($passwordHasher->hashPassword($user, $data['password']));

        $user->setRoles(['ROLE_USER']);
        $user->setCreatedAt(new \DateTimeImmutable());
        $user->setUpdatedAt(new \DateTimeImmutable());

        $errors = $validator->validate($user);
        if (count($errors) > 0) {
            return new JsonResponse(['errors' => (string) $errors], JsonResponse::HTTP_BAD_REQUEST);
        }

        try {
            $entityManager->persist($user);
            $entityManager->flush();
        } catch (UniqueConstraintViolationException) {
            return new JsonResponse([
                'error' => 'Email or phone already in use.',
            ], JsonResponse::HTTP_CONFLICT);
        }

        try {
            $emailVerifier->sendEmailConfirmation('api_verify_email', $user);

            return new JsonResponse([
                'message' => 'User registered successfully. Please verify your email.',
            ], JsonResponse::HTTP_CREATED);
        } catch (\Throwable) {
            // Registration is successful even if SMTP is temporarily unavailable.
            return new JsonResponse([
                'message' => 'User registered successfully, but verification email could not be sent right now.',
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
            return new JsonResponse(['error' => 'Missing or invalid user id.'], JsonResponse::HTTP_BAD_REQUEST);
        }

        $user = $userRepository->find($id);
        if (!$user instanceof User) {
            return new JsonResponse(['error' => 'User not found.'], JsonResponse::HTTP_NOT_FOUND);
        }

        try {
            $emailVerifier->handleEmailConfirmation($request->getUri(), $user);
        } catch (\RuntimeException $e) {
            return new JsonResponse(['error' => $e->getMessage()], JsonResponse::HTTP_BAD_REQUEST);
        }

        return new JsonResponse(['message' => 'Email verified successfully.'], JsonResponse::HTTP_OK);
    }
}
