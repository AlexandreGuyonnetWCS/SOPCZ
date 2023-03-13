<?php

namespace App\DataFixtures;

use App\Entity\BaseAutorisation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class BaseAutorisationFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $baseAutorisation = new BaseAutorisation();

    }
}
