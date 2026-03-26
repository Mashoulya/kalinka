<?php
namespace App\Tests\Entity;
use PHPUnit\Framework\TestCase;
use App\Entity\Photo;

class PhotoTest extends TestCase
{
    public function testPhotoEntity(): void
    {
        $photo = new Photo();

        $fileData = 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxMSEhUTExMWFhUXGR8aGBgYHh8fIB8fHx8fHx8fHSggHRolHR8fITEhJSkrLi4uFx8zODMsNygtLisBCgoKDg0OGxAQGy0lHyUt';

        $photo->setFileData($fileData);
        $this->assertEquals($fileData, $photo->getFileData());

        $createdAt = new \DateTimeImmutable();
        $photo->setCreatedAt($createdAt);
        $this->assertEquals($createdAt, $photo->getCreatedAt());

        $updatedAt = new \DateTimeImmutable();
        $photo->setUpdatedAt($updatedAt);
        $this->assertEquals($updatedAt, $photo->getUpdatedAt());
    }
}