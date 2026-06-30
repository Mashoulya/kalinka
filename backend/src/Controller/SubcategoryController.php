<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\SubcategoryRepository;

final class SubcategoryController extends AbstractController
{
    #[Route('/api/subcategories', name: 'app_subcategories', methods: ['GET'])]
    public function index(SubcategoryRepository $subcategoryRepository): JsonResponse
    {
        $subcategories = $subcategoryRepository->findAll();

        $data = [];
        foreach ($subcategories as $subcategory) {
            $data[] = [
                'id' => $subcategory->getId(),
                'slug' => $subcategory->getSlug(),
                'name' => $subcategory->getName(),
            ];
        }

        return $this->json($data);
    }
}
