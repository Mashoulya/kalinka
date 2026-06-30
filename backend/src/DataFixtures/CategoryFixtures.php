<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Category;
use App\Entity\Subcategory;
use Cocur\Slugify\Slugify;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $slugify = new Slugify();

        for($i = 0; $i < 10; $i++) {
            $category = new Category();
            $category->setName($faker->word());
            $category->setSlug($slugify->slugify($category->getName()) . '-' . $i);
            $manager->persist($category);
        }

        $manager->flush();
    }
}
