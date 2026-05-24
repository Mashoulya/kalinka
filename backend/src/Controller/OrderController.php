<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\User;
use App\Repository\OrderRepository;

final class OrderController extends AbstractController
{
    #[Route('/api/orders', name: 'app_orders', methods: ['GET'])]
    public function index(OrderRepository $orderRepository): JsonResponse
    {
        $user = $this->getUser();
        if (!$user instanceof User) {
            return new JsonResponse([
                'error' => 'Utilisateur non authentifie.',
            ], JsonResponse::HTTP_UNAUTHORIZED);
        }

        $orders = $orderRepository->findByUser($user);
        
        $data = [];
        foreach ($orders as $order) {
            $data[] = [
                'id' => $order->getId(),
                'totalPrice' => $order->getTotal(),
                'status' => $order->getStatus()?->value,
                'createdAt' => $order->getCreatedAt()?->format('Y-m-d H:i:s'),
            ];
        }
        return $this->json($data);
    }
}
