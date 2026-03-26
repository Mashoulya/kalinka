<?php
namespace App\Tests\Entity;
use PHPUnit\Framework\TestCase;
use App\Entity\Message;

class MessageTest extends TestCase
{
    public function testMessageEntity(): void
    {
        $message = new Message();

        $authorFirstName = 'John';
        $message->setAuthorFirstName($authorFirstName);
        $this->assertEquals($authorFirstName, $message->getAuthorFirstName());

        $authorLastName = 'Doe';
        $message->setAuthorLastName($authorLastName);
        $this->assertEquals($authorLastName, $message->getAuthorLastName());

        $email = 'john.doe@mail.com';
        $message->setEmail($email);
        $this->assertEquals($email, $message->getEmail());

        $phone = '02 34 56 78 90';
        $message->setPhone($phone);
        $this->assertEquals($phone, $message->getPhone());
       
        $content = 'Test message content';
        $message->setContent($content);
        $this->assertEquals($content, $message->getContent());

        $ipAddress = '192.168.1.1';
        $message->setIpAddress($ipAddress);
        $this->assertEquals($ipAddress, $message->getIpAddress());

        $createdAt = new \DateTimeImmutable();
        $message->setCreatedAt($createdAt);
        $this->assertEquals($createdAt, $message->getCreatedAt());
    }
}