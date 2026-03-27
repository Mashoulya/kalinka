<?php

namespace App\DataFixtures;

use App\Entity\Review;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ReviewFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $review = new Review();

            $rating = $faker->numberBetween(1, 5);

            $review->setExternalId($faker->uuid());
            $review->setUserName($faker->name());
            $review->setRating($rating);
            $review->setIsPositive($rating >= 4);

            // commentaires réalistes selon note
            if ($rating >= 4) {
                $review->setComment($faker->sentence(12));
            } elseif ($rating === 3) {
                $review->setComment($faker->sentence(10));
            } else {
                $review->setComment($faker->sentence(8));
            }

            $review->setTime(
                \DateTimeImmutable::createFromMutable(
                    $faker->dateTimeBetween('-1 years', 'now')
                )
            );

            $manager->persist($review);
        }

        $manager->flush();
    }
}