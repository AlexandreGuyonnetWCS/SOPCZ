<?php

namespace App\Controller\Admin;

use App\Entity\DiplomeNom;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class DiplomeNomCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DiplomeNom::class;
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
            ->setEntityLabelInSingular('Nom de diplôme')
            ->setEntityLabelInPlural('Noms de diplôme')
            ->setSearchFields(['id', 'name'])
            ->setPaginatorPageSize(30)
            ;
    }
}
