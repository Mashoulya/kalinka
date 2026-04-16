<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

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
}
