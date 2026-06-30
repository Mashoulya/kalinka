<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Product;
use App\Entity\Subcategory;
use App\Entity\Unit;
use Cocur\Slugify\Slugify;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @return array<class-string>
     */
    public function getDependencies(): array
    {
        return [
            SubcategoryFixtures::class,
            UnitFixtures::class,
        ];
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $subcategories = $manager->getRepository(Subcategory::class)->findAll();
        $units = $manager->getRepository(Unit::class)->findAll();

        if ($subcategories === []) {
            throw new \RuntimeException('No subcategories found. Load SubcategoryFixtures before ProductFixtures.');
        }

        if ($units === []) {
            throw new \RuntimeException('No units found. Load UnitFixtures before ProductFixtures.');
        }

        $slugify = new Slugify();

        for ($i = 0; $i < 200; $i++) {
            $product = new Product();
            $product->setName($faker->word());
            $product->setSlug($slugify->slugify($product->getName()) . '-' . $i);
            $product->setPrice($faker->randomFloat(2, 0.5, 100));

            $subcategory = $faker->randomElement($subcategories);
            $product->setSubcategory($subcategory);

            // Choisir une unite aleatoire
            $unit = $faker->randomElement($units);
            $product->setUnit($unit);

            // Generer weightVolume selon l'unite
            switch ($unit->getCode()) {
                case 'kg':
                    $weight = $faker->randomFloat(3, 0.1, 10);
                    break;
                case 'gr':
                    $weight = $faker->numberBetween(50, 500); // en grammes
                    break;
                case 'l':
                    $weight = $faker->randomFloat(2, 0.1, 5);
                    break;
                case 'ml':
                    $weight = $faker->numberBetween(10, 900);
                    break;
                case 'cl':
                    $weight = $faker->numberBetween(1, 90);
                    break;
                case 'oz':
                    $weight = $faker->randomFloat(2, 1, 16);
                    break;
                default:
                    $weight = $faker->randomFloat(2, 0.1, 10);
            }

            $product->setWeightVolume($weight);

            $product->setDescription($faker->paragraph());

            $manager->persist($product);
        }

        $manager->flush();
    }
}