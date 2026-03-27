<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Enum\Gender;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }
    
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 100; $i++) {
            $user = new User();

            $user->setTitle($faker->randomElement([Gender::Mr, Gender::Mrs, Gender::Other]));
            $user->setFirstName($faker->firstName());
            $user->setLastName($faker->lastName());
            $user->setBirthDate(\DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-80 years', '-18 years')));
            $user->setPostalCode($faker->postcode());
            $user->setCity($faker->city());
            $user->setPhone($faker->phoneNumber());
            $user->setEmail($faker->unique()->email());

            $user->setPassword(
                $this->passwordHasher->hashPassword($user, 'password123')
            );

            $manager->persist($user);
        }

        $manager->flush();
    }
}