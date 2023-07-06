<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\DiplomeFull;
use Faker\Factory;

class DiplomeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $diplome = new DiplomeFull();

        $diplome->setDiplomeType('CACES')
            ->setDiplomeName('R482')
            ->setDiplomeCategory('A')
            ->setDescription('Engins compacts (pelles à chenilles ou sur pneumatiques, chargeuses à chenilles ou sur pneumatiques, chargeuses-pelleteuses, moto-basculeurs et compacteurs ≤ 6 tonnes ; tracteurs agricoles ≤ 100 cv)')
            ->setValidite('10')
            ->setImage($faker->imageUrl(640, 480, 'technics', true, 'Faker', true));
        $manager->persist($diplome);

        $diplome = new DiplomeFull();

        $diplome->setDiplomeType('CACES')
            ->setDiplomeName('R482')
            ->setDiplomeCategory('B1')
            ->setDescription('Engins d’extraction à déplacement séquentiel (pelles à chenilles ou sur pneumatiques > 6 tonnes, pelles multifonctions')
            ->setValidite('10')
            ->setImage($faker->imageUrl(640, 480, 'technics', true, 'Faker', true));
        $manager->persist($diplome);

        $diplome = new DiplomeFull();

        $diplome->setDiplomeType('CACES')
            ->setDiplomeName('R482')
            ->setDiplomeCategory('B2')
            ->setDescription('Engins de sondage ou de forage à déplacement séquentiel (machines automotrices de sondage ou de forage)')
            ->setValidite('10')
            ->setImage($faker->imageUrl(640, 480, 'technics', true, 'Faker', true));
        $manager->persist($diplome);

        $diplome = new DiplomeFull();

        $diplome->setDiplomeType('CACES')
            ->setDiplomeName('R482')
            ->setDiplomeCategory('B3')
            ->setDescription('Engins rail-route à déplacement séquentiel (pelles hydrauliques rail-route)')
            ->setValidite('10')
            ->setImage($faker->imageUrl(640, 480, 'technics', true, 'Faker', true));
        $manager->persist($diplome);

        $diplome = new DiplomeFull();

        $diplome->setDiplomeType('CACES')
            ->setDiplomeName('R482')
            ->setDiplomeCategory('C1')
            ->setDescription('Engins de chargement à déplacement alternatif (chargeuses sur pneumatiques et chargeuses-pelleteuses > 6 tonnes)')
            ->setValidite('10')
            ->setImage($faker->imageUrl(640, 480, 'technics', true, 'Faker', true));
        $manager->persist($diplome);

        $diplome = new DiplomeFull();

        $diplome->setDiplomeType('CACES')
            ->setDiplomeName('R482')
            ->setDiplomeCategory('C2')
            ->setDescription(' Engins de réglage à déplacement alternatif (bouteurs, chargeuses à chenilles > 6 tonnes)')
            ->setValidite('10')
            ->setImage($faker->imageUrl(640, 480, 'technics', true, 'Faker', true));
        $manager->persist($diplome);

        $diplome = new DiplomeFull();

        $diplome->setDiplomeType('CACES')
            ->setDiplomeName('R482')
            ->setDiplomeCategory('C3')
            ->setDescription('Engins de nivellement à déplacement alternatif (niveleuses automotrices)')
            ->setValidite('10')
            ->setImage($faker->imageUrl(640, 480, 'technics', true, 'Faker', true));
        $manager->persist($diplome);

        $diplome = new DiplomeFull();

        $diplome->setDiplomeType('CACES')
            ->setDiplomeName('R482')
            ->setDiplomeCategory('D')
            ->setDescription('Engins de compactage (compacteurs à cylindres, à pneumatiques, mixtes et à pieds dameurs > 6 tonnes)')
            ->setValidite('10')
            ->setImage($faker->imageUrl(640, 480, 'technics', true, 'Faker', true));
        $manager->persist($diplome);

        $diplome = new DiplomeFull();

        $diplome->setDiplomeType('CACES')
            ->setDiplomeName('R482')
            ->setDiplomeCategory('E')
            ->setDescription('Engins de transport (tombereaux rigides ou articulés, moto-basculeurs > 6 tonnes, tracteurs agricoles > 100 cv)')
            ->setValidite('10')
            ->setImage($faker->imageUrl(640, 480, 'technics', true, 'Faker', true));
        $manager->persist($diplome);

        $diplome = new DiplomeFull();

        $diplome->setDiplomeType('CACES')
            ->setDiplomeName('R482')
            ->setDiplomeCategory('F')
            ->setDescription('Chariots de manutention tout-terrain (à mât ou à flèche télescopique)')
            ->setValidite('10')
            ->setImage($faker->imageUrl(640, 480, 'technics', true, 'Faker', true));
        $manager->persist($diplome);

        $diplome = new DiplomeFull();

        $diplome->setDiplomeType('Travaux en hauteur')
            ->setDiplomeName('Echafaudage')
            ->setDiplomeCategory('Roulant')
            ->setDescription('Echafaudage roulant')
            ->setValidite('10')
            ->setImage($faker->imageUrl(640, 480, 'technics', true, 'Faker', true));
        $manager->persist($diplome);

        $diplome = new DiplomeFull();

        $diplome
            ->setDiplomeType('Travaux en hauteur')
            ->setDiplomeName('Echafaudage')
            ->setDiplomeCategory('Montage et démontage')
            ->setDescription('Montage et démontage d\'échafaudage')
            ->setValidite('10')
            ->setImage($faker->imageUrl(640, 480, 'technics', true, 'Faker', true));
        $manager->persist($diplome);

        $diplome = new DiplomeFull();

        $diplome
            ->setDiplomeType('Travaux en hauteur')
            ->setDiplomeName('Port du harnais')
            ->setDiplomeCategory('Harnais')
            ->setDescription('Port du harnais')
            ->setValidite('10')
            ->setImage($faker->imageUrl(640, 480, 'technics', true, 'Faker', true));
        $manager->persist($diplome);

        $diplome = new DiplomeFull();

        $diplome
            ->setDiplomeType('Habilitation électrique')
            ->setDiplomeName('non electricien')
            ->setDiplomeCategory('B0 - H0V')
            ->setDescription('TBT-BT-HT')
            ->setValidite('10')
            ->setImage($faker->imageUrl(640, 480, 'technics', true, 'Faker', true));
        $manager->persist($diplome);

        $diplome = new DiplomeFull();

        $diplome
            ->setDiplomeType('Habilitation électrique')
            ->setDiplomeName('electricien')
            ->setDiplomeCategory('TBT-BT')
            ->setDescription('electricien TBT-BT')
            ->setValidite('10')
            ->setImage($faker->imageUrl(640, 480, 'technics', true, 'Faker', true));
        $manager->persist($diplome);

        $diplome = new DiplomeFull();

        $diplome
            ->setDiplomeType('Habilitation électrique')
            ->setDiplomeName('electricien')
            ->setDiplomeCategory('TBT-BT-HT')
            ->setDescription('electricien TBT-BT-HT')
            ->setValidite('10')
            ->setImage($faker->imageUrl(640, 480, 'technics', true, 'Faker', true));
        $manager->persist($diplome);

        $manager->flush();
    }
}
