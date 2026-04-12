<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ProductRepository;

final class ProductController extends AbstractController
{
    #[Route('/api/products', name: 'app_products', methods: ['GET'])]
    public function index(ProductRepository $productRepository): JsonResponse
    {
        $products = $productRepository->findAllWithUnitAndPhotos();

        $data = [];
        foreach ($products as $product) {
            $mainPhoto = $product->getPhotos()->first();

            $data[] = [
                'id' => $product->getId(),
                'name' => $product->getName(),
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
