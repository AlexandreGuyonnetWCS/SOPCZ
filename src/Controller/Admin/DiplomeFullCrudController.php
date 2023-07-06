<?php

namespace App\Controller\Admin;

use App\Entity\DiplomeFull;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class DiplomeFullCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DiplomeFull::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('diplomeType')
            ->setLabel('Type de diplôme'),
            TextField::new('diplomeName')
            ->setLabel('Nom du diplôme'),
            TextField::new('diplomeCategory')
            ->setLabel('Catégorie du diplôme'),
            TextField::new('description'),
            ChoiceField::new('validite')->setChoices([
                1 => 1,
                3 => 3,
                5 => 5,
                10 => 10,
                ]),
            ImageField::new('image')
            ->setBasePath('uploads/images')
            ->setUploadDir('public/uploads/images')
            ->setUploadedFileNamePattern('[randomhash].[extension]')
            ->setRequired(false),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Base de Diplôme')
            ->setEntityLabelInPlural('Base des Diplômes')
            ->setSearchFields(['id', 'name'])
            ->setPaginatorPageSize(30)
        ;
    }
}
