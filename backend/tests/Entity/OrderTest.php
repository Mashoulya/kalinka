<?php
namespace App\Tests\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\Order;
use App\Entity\OrderItem;
use App\Enum\Status;

class OrderTest extends TestCase
{
    public function testGetSet(): void
    {
        $order = new Order();

        $order->setTotal(21.45);
        $this->assertEquals(21.45, $order->getTotal());

        $order->setStatus(Status::Preparing);
        $this->assertSame(Status::Preparing, $order->getStatus());

        $this->assertInstanceOf(\DateTimeImmutable::class, $order->getCreatedAt());
        $now = new \DateTimeImmutable();
        $order->setUpdatedAt($now);
        $this->assertSame($now, $order->getUpdatedAt());

        $orderItem = new OrderItem();
        $order->addItem($orderItem);
        $this->assertTrue($order->getItems()->contains($orderItem));
        $this->assertSame($order, $orderItem->getOrderRef());
    }
}