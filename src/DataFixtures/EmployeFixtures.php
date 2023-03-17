<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Employe;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class EmployeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $employes = [];

        for ($i = 0; $i < 50; $i++) {
            $employe = new Employe();
            $employe->setGenre($faker->randomElement(['Monsieur', 'Madame', 'Mademoiselle']));
            $employe->setNom($faker->lastName());
            $employe->setPrenom($faker->firstName());
            $employe->setDepartement($faker->randomElement(['1', '2', '3', '4', '5']));
            $employe->setPoste($faker->randomElement(['Fontainier', 'Chauffagiste', 'Plombier', 'Electricien']));
            $employe->setAmco($faker->dateTimeBetween('-10 years', 'now'));
            $employe->setPhoto('https://picsum.photos/800/600?random=' . $i);
            $employes[] = $employe;
            $manager->persist($employe);
        }
        $manager->flush();
    }
}
