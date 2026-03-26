<?php
namespace App\Tests\Entity;
use PHPUnit\Framework\TestCase;
use App\Entity\OrderItem;
use App\Entity\Order;
use App\Entity\Product;

class OrderItemTest extends TestCase
{
    public function testOrderItemEntity(): void
    {
        $orderItem = new OrderItem();
       
        $quantity = 5;
        $orderItem->setQuantity($quantity);
        $this->assertEquals($quantity, $orderItem->getQuantity());

        $unitPrice = '12.99';
        $orderItem->setUnitPrice($unitPrice);
        $this->assertEquals($unitPrice, $orderItem->getUnitPrice());

        // Test relations
        $order = new Order();
        $product = new Product();

        $orderItem->setOrderRef($order);
        $orderItem->setProduct($product);

        $this->assertSame($order, $orderItem->getOrderRef());
        $this->assertSame($product, $orderItem->getProduct());
    }
}