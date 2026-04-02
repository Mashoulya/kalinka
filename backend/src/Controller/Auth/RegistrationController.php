<?php

namespace App\Controller\Auth;

use App\Entity\User;
use App\Enum\Gender;
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

    public function register(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager, ValidatorInterface $validator): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

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
        $user->setPhone($data['phone']);
        $user->setEmail($data['email']);
        $user->setPassword($passwordHasher->hashPassword($user, $data['password']));

        $user->setRoles(['ROLE_USER']);
        $user->setCreatedAt(new \DateTimeImmutable());
        $user->setUpdatedAt(new \DateTimeImmutable());

        $errors = $validator->validate($user);
        if (count($errors) > 0) {
            return new JsonResponse(['errors' => (string) $errors], JsonResponse::HTTP_BAD_REQUEST);
        }

        $entityManager->persist($user);
        $entityManager->flush();

        return new JsonResponse(['message' => 'User registered successfully'], JsonResponse::HTTP_CREATED);
    }
}
