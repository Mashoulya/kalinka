<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Category;
use App\Entity\Subcategory;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $category = new Category();
            $name = $faker->word();
            $category->setName($name);
            $category->setSlug(strtolower(preg_replace('/[^a-z0-9]+/i', '-', $name)) . '-' . $i);
            $manager->persist($category);
        }

        $manager->flush();
    }
}
