<?php
namespace App\Tests\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\Category;

class CategoryTest extends TestCase
{
    public function testCategoryEntity(): void
    {
        $category = new Category();
       
        $name = 'Test Category';
        $category->setName($name);
        $this->assertEquals($name, $category->getName());

        $createdAt = new \DateTimeImmutable('2026-01-01 10:00:00');
        $category->setCreatedAt($createdAt);
        $this->assertEquals($createdAt, $category->getCreatedAt());

        $updatedAt = new \DateTimeImmutable('2026-01-12 08:40:35');
        $category->setUpdatedAt($updatedAt);
        $this->assertEquals($updatedAt, $category->getUpdatedAt());
    }
}