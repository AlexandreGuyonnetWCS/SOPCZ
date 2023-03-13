<?php

namespace App\DataFixtures;

use App\Entity\Diplome;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;


class DiplomeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $diplomes = [];

        for ($i = 0; $i < 70; $i++) {
            $diplome = new Diplome();
            $diplome->setType($faker->randomElement(['CACES', 'Habilitation']));
            $diplome->setNom($faker->randomElement(['R372', 'R482', 'R484', 'R483', 'R485', 'R386', '486', 'R489', 'R490', 'Habilitation électique basse tension', 'Habilitation électique haute tension', 'Echafaudage', 'Habilitation électique', 'Travaux en hauteur']));
            $diplome->setCategorie($faker->randomElement(['A', 'B1', 'B2', 'B3', 'C1', 'C2', 'C3', 'D', 'E', 'F', 'G', '2', '3', '4', '5', '6', '7', '1A', '1B', '2A', '2B', 'grues de chargement', 'roulant', 'H0V', 'H1V', 'H2V', 'HC', 'B0V', 'B1V', 'B2V', 'BC', 'BR']));
            $diplome->setValidite($faker->randomElement(['1 ans', '2 ans', '3 ans', '5 ans', '10 ans']));
            $diplome->setDescription($faker->text(20));
            $diplome->setImage('https://picsum.photos/200/300/?' . $i);
            $diplomes[] = $diplome;
            $manager->persist($diplome);
        }

        $manager->flush();
    }
}

