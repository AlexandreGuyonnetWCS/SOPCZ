<?php

namespace App\DataFixtures;

use App\Entity\Entreprise;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EntrepriseFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $entreprise = new Entreprise();
        $entreprise->setNom('SOCPZ');
        $entreprise->setAdresse('6 Allée Louis-Charles et Henri GEAY BP1124');
        $entreprise->setCodePostal('87280');
        $entreprise->setVille('LIMOGES');
        $entreprise->setContacte('05 55 45 45 45');
        $entreprise->setGenreDirecteur('Monsieur');
        $entreprise->setNomDirecteur('DUPONT');
        $entreprise->setPrenomDirecteur('Jean');
        $entreprise->setSignatureDirecteur('uploads/signature/signature.png');
        $entreprise->setLogo('uploads/logo/logo.png');
        $entreprise->setSiret('12345678912345');
        $manager->persist($entreprise);
        $manager->flush();
    }
}
