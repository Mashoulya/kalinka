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
        $subcategorySlug = $request->query->getString('subcategory');

        if ($subcategorySlug !== '') {
            $products = $productRepository->findProductsBySubcategory($subcategorySlug);
        } else {
            $products = $productRepository->findAllWithUnitAndPhotos();
        }

        $data = [];
        foreach ($products as $product) {
            $mainPhoto = $product->getPhotos()->first();

            $data[] = [
                'id' => $product->getId(),
                'slug' => $product->getSlug(),
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
