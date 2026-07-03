<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Category;
use App\Entity\Subcategory;

class SubcategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $categories = $manager->getRepository(Category::class)->findAll();

        foreach ($categories as $category) {
            for ($j = 0; $j < rand(2, 4); $j++) {
                $subcategory = new Subcategory();
                $name = $faker->unique()->word();
                $subcategory->setName($name);
                $subcategory->setSlug(strtolower(preg_replace('/[^a-z0-9]+/i', '-', $name)) . '-' . $j . '-' . $category->getId());
                $subcategory->setCategory($category);
                $manager->persist($subcategory);
            }
        }

        $manager->flush();
    }
}
