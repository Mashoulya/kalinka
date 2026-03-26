<?php
namespace App\Tests\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\Product;
use App\Entity\Unit;
use App\Entity\Subcategory;
use App\Entity\Photo;

class ProductTest extends TestCase
{
    public function testGetSet(): void
    {
        $product = new Product();

        $product->setName('Produit A');
        $this->assertEquals('Produit A', $product->getName());

        $product->setPrice('12.99');
        $this->assertEquals('12.99', $product->getPrice());

        $product->setWeightVolume('0.500');
        $this->assertEquals('0.500', $product->getWeightVolume());

        $product->setDescription('Description du produit');
        $this->assertEquals('Description du produit', $product->getDescription());

        $this->assertInstanceOf(\DateTimeImmutable::class, $product->getCreatedAt());

        $now = new \DateTimeImmutable();
        $product->setUpdatedAt($now);
        $this->assertSame($now, $product->getUpdatedAt());

        // Test relations Unit
        $unit = new Unit();
        $unit->setName('kg'); // valeur réaliste
        $product->setUnit($unit);
        $this->assertSame($unit, $product->getUnit());
        $this->assertEquals('kg', $product->getUnit()->getName());

        // Test relations Subcategory
        $subcategory = new Subcategory();
        $subcategory->setName('Fruits'); // valeur réaliste
        $product->setSubcategory($subcategory);
        $this->assertSame($subcategory, $product->getSubcategory());
        $this->assertEquals('Fruits', $product->getSubcategory()->getName());

        // Test ajout à collection (Photo)
        $photo = new Photo();
        $product->addPhoto($photo);
        $this->assertTrue($product->getPhotos()->contains($photo));
        $this->assertSame($product, $photo->getProduct());
    }
}