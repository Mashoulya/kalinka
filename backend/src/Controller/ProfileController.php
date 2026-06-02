<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

final class ProfileController extends AbstractController
{
    #[Route('/api/me', name: 'api_me', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $user = $this->getUser();
        if (!$user instanceof User) {
            return $this->json(['error' => 'User not authenticated'], JsonResponse::HTTP_UNAUTHORIZED);
        }

        $orders = $user->getOrders()->toArray();
        usort(
            $orders,
            static fn (Order $a, Order $b): int => $b->getCreatedAt()->getTimestamp() <=> $a->getCreatedAt()->getTimestamp()
        );

        $ordersData = array_map(
            static fn (Order $order): array => [
                'number' => $order->getId(),
                'date' => $order->getCreatedAt()?->format('Y-m-d H:i:s'),
                'price' => $order->getTotal(),
                'status' => $order->getStatus()?->value,
            ], $orders);

        return $this->json([
            'orders' => $ordersData,
            'credentials' => [
                'email' => $user->getEmail(),
            ],
            'profile' => [
                'title' => $user->getTitle()?->value,
                'lastName' => $user->getLastName(),
                'firstName' => $user->getFirstName(),
                'birthDate' => $user->getBirthDate()?->format('Y-m-d'),
                'postalCode' => $user->getPostalCode(),
                'city' => $user->getCity(),
                'phone' => $user->getPhone(),
            ],
        ]);
    }

    #[Route('/api/me/password', name: 'api_me_update', methods: ['PUT'])]
    public function updatePassword(UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager, Request $request): JsonResponse
    {
        $user = $this->getUser();
        if (!$user instanceof User) {
            return $this->json(['error' => 'User not authenticated'], JsonResponse::HTTP_UNAUTHORIZED);
        }

        $data = json_decode($request->getContent(), true);
        if (!is_array($data)) {
            return $this->json(['error' => 'Corps JSON invalide'], JsonResponse::HTTP_BAD_REQUEST);
        }

        $oldPassword = (string) ($data['oldPassword'] ?? '');
        $newPassword = (string) ($data['newPassword'] ?? '');
        $confirmPassword = (string) ($data['confirmPassword'] ?? '');

        if ($oldPassword === '' || $newPassword === '' || $confirmPassword === '') {
            return $this->json(['error' => 'Tous les champs sont obligatoires'], JsonResponse::HTTP_BAD_REQUEST);
        }

        if (!$passwordHasher->isPasswordValid($user, $oldPassword)) {
            return $this->json(['error' => 'Mot de passe actuel incorrect'], JsonResponse::HTTP_BAD_REQUEST);
        }

        if ($newPassword !== $confirmPassword) {
            return $this->json(['error' => 'Le nouveau mot de passe et sa confirmation ne correspondent pas'], JsonResponse::HTTP_BAD_REQUEST);
        }

        $user->setPassword($passwordHasher->hashPassword($user, $newPassword));
        $entityManager->flush();

        return $this->json(['message' => 'Mot de passe mis à jour avec succès'], JsonResponse::HTTP_OK);
    }

    #[Route('/api/me/profile', name: 'api_me_profile_update', methods: ['PATCH'])]
    public function updateProfile() {

    }
}
