<?php

namespace App\Controller\Admin;

use App\Entity\DiplomeCategorie;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class DiplomeCategorieCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DiplomeCategorie::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Nom'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Catégorie de diplôme')
            ->setEntityLabelInPlural('Catégories de diplôme')
            ->setSearchFields(['id', 'name'])
            ->setPaginatorPageSize(30)
            ;
    }
}
