<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ReviewRepository;

final class ReviewController extends AbstractController
{
    #[Route('/api/reviews', name: 'app_reviews', methods: ['GET'])]
    public function index(ReviewRepository $reviewRepository): JsonResponse
    {
        $reviews = $reviewRepository->findPositiveReviews();
       
        $data = [];
        foreach ($reviews as $review) {
            $data[] = [
                'id' => $review->getId(),
                'userName' => $review->getUserName(),
                'rating' => $review->getRating(),
                'comment' => $review->getComment(),
            ];
        }

        return $this->json($data);
    }
}
