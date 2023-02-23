<?php

namespace App\Controller\Admin;

use App\Entity\Entreprise;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class EntrepriseCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Entreprise::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            TextField::new('adresse'),
            TextField::new('codePostal'),
            TextField::new('ville'),
            TextField::new('Siret'),
            ImageField::new('logo')
            ->setBasePath('uploads/logos/')
            ->setUploadDir('public/uploads/logos/')
            ->setUploadedFileNamePattern('[randomhash].[extension]')
            ->setRequired(false)
            ->setLabel('Logo de l\'entreprise'),
            ChoiceField::new('GenreDirecteur')
            ->setChoices([
                'Monsieur' => 'Monsieur',
                'Madame' => 'Madame',
                'Mademoiselle' => 'Mademoiselle',
            ]),
            TextField::new('NomDirecteur')
            ->setLabel('Nom du directeur'),
            TextField::new('PrenomDirecteur')
            ->setLabel('Prénom du directeur'),
            ImageField::new('SignatureDirecteur')
            ->setBasePath('uploads/signatures/')
            ->setUploadDir('public/uploads/signatures/')
            ->setUploadedFileNamePattern('[randomhash].[extension]')
            ->setRequired(false)
            ->setLabel('Signature du directeur'),
            TextField::new('Contacte')
            ->setLabel('Numero de téléphone'),
            
        ];
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
