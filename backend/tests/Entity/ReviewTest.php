<?php
namespace App\Tests\Entity;
use PHPUnit\Framework\TestCase;
use App\Entity\Review;

class ReviewTest extends TestCase
{
    public function testReviewEntity()
    {
        $review = new Review();
        $externalId = 'abc123';
        $review->setExternalId($externalId);
        $this->assertEquals($externalId, $review->getExternalId());

        $userName = 'John Doe';
        $review->setUserName($userName);
        $this->assertEquals($userName, $review->getUserName());

        $isPositive = true;
        $review->setIsPositive($isPositive);
        $this->assertEquals($isPositive, $review->isPositive());

        $rating = 4;
        $review->setRating($rating);
        $this->assertEquals($rating, $review->getRating());

        $comment = 'Great products!';
        $review->setComment($comment);
        $this->assertEquals($comment, $review->getComment());
    
        $createdAt = new \DateTimeImmutable('2026-01-01 10:00:00');
        $review->setCreatedAt($createdAt);
        $this->assertEquals($createdAt, $review->getCreatedAt());

        $updatedAt = new \DateTimeImmutable('2026-01-12 08:40:35');
        $review->setUpdatedAt($updatedAt);
        $this->assertEquals($updatedAt, $review->getUpdatedAt());
    }
}