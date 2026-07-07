<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

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

        $data = array_map(fn (Product $product) => $this->formatProduct($product), $products);

        return $this->json($data);
    }

    #[Route('/api/products/{slug}', name: 'app_product_show', methods: ['GET'])]
    public function show(string $slug, ProductRepository $productRepository): JsonResponse
    {
        $product = $productRepository->findOneBySlugWithRelations($slug);

        if (!$product) {
            return $this->json(['message' => 'Produit introuvable.'], 404);
        }

        return $this->json($this->formatProduct($product));
    }

    private function formatProduct(Product $product): array
    {
        $mainPhoto = $product->getPhotos()->first();

        return [
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
            'subcategory' => $product->getSubcategory() ? [
                'id' => $product->getSubcategory()->getId(),
                'name' => $product->getSubcategory()->getName(),
                'slug' => $product->getSubcategory()->getSlug(),
            ] : null,
            'category' => $product->getSubcategory() && $product->getSubcategory()->getCategory() ? [
                'id' => $product->getSubcategory()->getCategory()->getId(),
                'name' => $product->getSubcategory()->getCategory()->getName(),
                'slug' => $product->getSubcategory()->getCategory()->getSlug(),
            ] : null,
        ];
    }
}
