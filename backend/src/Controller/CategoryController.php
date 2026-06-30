<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class CategoryController extends AbstractController
{
    #[Route('/api/categories', name: 'app_categories', methods: ['GET'])]
    public function index(CategoryRepository $categoryRepository): JsonResponse
    {
        $categories = $categoryRepository->findAllWithSubcategories();

        return $this->json($this->formatCategories($categories, false));
    }

    #[Route('/api/categories/menu', name: 'app_categories_menu', methods: ['GET'])]
    public function menu(CategoryRepository $categoryRepository): JsonResponse
    {
        $categories = $categoryRepository->findMenuTree();

        return $this->json($this->formatCategories($categories, true));
    }

    private function formatCategories(array $categories, bool $withProducts): array
    {
        $data = [];
        foreach ($categories as $category) {
            $subcategoryData = [];
            foreach ($category->getSubcategories() as $subcategory) {
                $item = [
                    'id' => $subcategory->getId(),
                    'name' => $subcategory->getName(),
                ];

                if ($withProducts) {
                    $productData = [];
                    foreach ($subcategory->getProducts() as $product) {
                        $productData[] = [
                            'id' => $product->getId(),
                            'name' => $product->getName(),
                            'price' => $product->getPrice(),
                            'size' => [
                                'weightVolume' => $product->getWeightVolume(),
                                'unit' => $product->getUnit()?->getCode(),
                            ],
                            'description' => $product->getDescription(),
                        ];
                    }
                    $item['products'] = $productData;
                }

                $subcategoryData[] = $item;
            }

            $data[] = [
                'id' => $category->getId(),
                'name' => $category->getName(),
                'subcategories' => $subcategoryData,
            ];
        }

        return $data;
    }
}
