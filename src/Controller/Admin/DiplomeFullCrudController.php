<?php

namespace App\Controller\Admin;

use App\Entity\DiplomeFull;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;

class DiplomeFullCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DiplomeFull::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('type', 'Type')
                ->setFormattedValue(fn ($value, $entity) => $entity->getDiplomeType()->getName()),
            AssociationField::new('name', 'Nom')
                ->setFormattedValue(fn ($value, $entity) => $entity->getDiplomeNom()->getName()),
            AssociationField::new('categorie', 'Catégorie')
                ->setFormattedValue(fn ($value, $entity) => $entity->getDiplomeCategorie()->getName()),
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