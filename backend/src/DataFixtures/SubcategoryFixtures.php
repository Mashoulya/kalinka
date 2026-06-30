<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Category;
use App\Entity\Subcategory;
use Cocur\Slugify\Slugify;

class SubcategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $categories = $manager->getRepository(Category::class)->findAll();

        $slugify = new Slugify();

        foreach ($categories as $category) {
            for ($j = 0; $j < rand(2, 4); $j++) {
                $subcategory = new Subcategory();
                $subcategory->setName($faker->unique()->word());
                $subcategory->setSlug($slugify->slugify($subcategory->getName()));
                $subcategory->setCategory($category);
                $manager->persist($subcategory);
            }
        }

        $manager->flush();
    }
}
