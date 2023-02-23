<?php

namespace App\Controller\Admin;

use App\Entity\Employe;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class EmployeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Employe::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            ChoiceField::new('genre')->setChoices([
                'Monsieur' => 'Monsieur',
                'Madame' => 'Madame',
                'Mademoiselle' => 'Mademoiselle',
            ]),
            TextField::new('nom'),
            TextField::new('prenom'),
            ChoiceField::new('poste')->setChoices([
                'Fontainier' => 'Fontainier',
                'Chauffagiste' => 'Chauffagiste',
                'Electricien' => 'Electricien',
                'Plombier' => 'Plombier',

            ]),
            ChoiceField::new('departement')->setChoices([
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6',
            ]),
            ImageField::new('photo')
            ->setBasePath('uploads/employes/')
            ->setUploadDir('public/uploads/employes/')
            ->setUploadedFileNamePattern('[randomhash].[extension]'),
            DateField::new('amco')
        ];
    }
}
