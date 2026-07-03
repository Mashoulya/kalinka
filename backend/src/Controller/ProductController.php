<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ProductRepository;

final class ProductController extends AbstractController
{
    #[Route('/api/products', name: 'app_products', methods: ['GET'])]
    public function index(ProductRepository $productRepository, Request $request): JsonResponse
    {
        $subcategoryId = $request->query->getInt('subcategory');

        if ($subcategoryId > 0) {
            $products = $productRepository->findProductsBySubcategory($subcategoryId);
        } else {
            $products = $productRepository->findAllWithUnitAndPhotos();
        }

        $data = [];
        foreach ($products as $product) {
            $mainPhoto = $product->getPhotos()->first();

            $data[] = [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'slug' => $product->getSlug(),
                'price' => $product->getPrice(),
                'size' => [
                    'weightVolume' => $product->getWeightVolume(),
                    'unit' => $product->getUnit()?->getCode(),
                ],
                'description' => $product->getDescription(),
                'photo' => $mainPhoto ? $mainPhoto->getFileData() : null,
            ];
        }

        return $this->json($data);
    }
}
