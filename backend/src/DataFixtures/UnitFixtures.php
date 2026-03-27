<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Unit;

class UnitFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $units = [
            ['name' => 'kilogramme', 'code' => 'kg'],
            ['name' => 'litre', 'code' => 'l'],
            ['name' => 'millilitre', 'code' => 'ml'],
            ['name' => 'centilitre', 'code' => 'cl'],
            ['name' => 'once', 'code' => 'oz'],
            ['name' => 'gramme', 'code' => 'gr'],
        ];

        foreach ($units as $data) {
            $unit = new Unit();
            $unit->setName($data['name']);
            $unit->setCode($data['code']);
            $manager->persist($unit);
        }
        $manager->flush();
    }
}