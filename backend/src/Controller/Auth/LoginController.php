<?php

namespace App\Controller\Auth;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class LoginController extends AbstractController
{
    #[Route('/api/login', name: 'api_login')]
    public function index(): JsonResponse
    {
        return new JsonResponse([
            'message' => 'Please log in to access this resource.'
        ], JsonResponse::HTTP_UNAUTHORIZED);
    }
}
