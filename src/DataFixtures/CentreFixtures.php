<?php

namespace App\DataFixtures;

use App\Entity\Centre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CentreFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $centres = [];

        for ($i = 0; $i < 10; $i++) {
            $centre = new Centre();
            $centre->setNom($faker->company());
            $centre->setAdresse($faker->address());
            $centre->setCodePostal($faker->randomNumber(5, true));
            $centre->setVille($faker->city());
            $centre->setTelephone($faker->phoneNumber());
            $centre->setmail($faker->email());
            $centres[] = $centre;
            $manager->persist($centre);
        }
        $manager->flush();
    }
}
