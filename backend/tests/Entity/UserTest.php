<?php
namespace App\Tests\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\User;
use App\Enum\Gender;

class UserTest extends TestCase
{
    public function testGetSet(): void
    {
        $user = new User();

        $user->setTitle(Gender::Mr);
        $this->assertEquals(Gender::Mr, $user->getTitle());

        $user->setFirstName('John');
        $this->assertEquals('John', $user->getFirstName());

        $user->setLastName('Doe');
        $this->assertEquals('Doe', $user->getLastName());

        $birth = new \DateTimeImmutable('2000-01-01');
        $user->setBirthDate($birth);
        $this->assertEquals($birth, $user->getBirthDate());

        $user->setPostalCode('75001');
        $this->assertEquals('75001', $user->getPostalCode());

        $user->setCity('Paris');
        $this->assertEquals('Paris', $user->getCity());

        $user->setPhone('0123456789');
        $this->assertEquals('0123456789', $user->getPhone());

        $user->setEmail('john.doe@example.com');
        $this->assertEquals('john.doe@example.com', $user->getEmail());

        $user->setPassword('password123!@');
        $this->assertEquals('password123!@', $user->getPassword());

        $now = new \DateTimeImmutable();
        $user->setUpdatedAt($now);
        $this->assertEquals($now, $user->getUpdatedAt());
    }
}