<?php
namespace App\Tests\Entity;
use PHPUnit\Framework\TestCase;
use App\Entity\Subcategory;

class SubcategoryTest extends TestCase
{
    public function testSubcategoryEntity(): void
    {
        $subcategory = new Subcategory();
       
        $name = 'Test Subcategory';
        $subcategory->setName($name);
        $this->assertEquals($name, $subcategory->getName());

        $createdAt = new \DateTimeImmutable('2026-01-01 10:00:00');
        $subcategory->setCreatedAt($createdAt);
        $this->assertEquals($createdAt, $subcategory->getCreatedAt());

        $updatedAt = new \DateTimeImmutable('2026-01-12 08:40:35');
        $subcategory->setUpdatedAt($updatedAt);
        $this->assertEquals($updatedAt, $subcategory->getUpdatedAt());

        $products = $subcategory->getProducts();
        $this->assertIsIterable($products);
    }
}