<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class ProfileController extends AbstractController
{
    #[Route('/api/me', name: 'app_me', methods: ['GET'])]
    public function index(): JsonResponse
    {
        if(!$this->getUser()) {
            return $this->json(['error' => 'Unauthorized'], 401);
        }

        $user = $this->getUser();

        return $this->json([
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'title' => $user->getTitle(),
            'lastName' => $user->getLastName(),
            'firstName' => $user->getFirstName(),
            'birthday' => $user->getBirthday() ? $user->getBirthday()->format('Y-m-d') : null,
            'postalCode' => $user->getPostalCode(),
            'city' => $user->getCity(),
            'phone' => $user->getPhone(),
        ]);

        return $this->json([
            
        ]);
    }
}
