<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Photo;
use App\Entity\Product;
use Faker\Factory;

class PhotoFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $products = $manager->getRepository('App\Entity\Product')->findAll();

        foreach ($products as $product) {
            for ($i = 0; $i < rand(1, 3); $i++) {
                $photo = new Photo();
                
                // On génère juste un nom de fichier fictif
                $photo->setFileData($faker->image('public/images', 640, 480, null, false));
                $photo->setProduct($product);
                
                $manager->persist($photo);
            }
        }

        $manager->flush();
    }
}
