<?php
namespace App\Tests\Entity;
use PHPUnit\Framework\TestCase;
use App\Entity\Unit;
use App\Entity\Product;

class UnitTest extends TestCase
{
    public function testUnitEntity(): void
    {
        $unit = new Unit();
       
        $name = 'Test Unit';
        $unit->setName($name);
        $this->assertEquals($name, $unit->getName());

        $code = 'kg';
        $unit->setCode($code);
        $this->assertEquals($code, $unit->getCode());

        $product = new Product();
        $unit->addProduct($product);
        $this->assertTrue($unit->getProducts()->contains($product));
    }
}