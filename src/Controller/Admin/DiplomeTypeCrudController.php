<?php

namespace App\Controller\Admin;

use App\Entity\DiplomeType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class DiplomeTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DiplomeType::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Type de diplôme'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Type de diplôme')
            ->setEntityLabelInPlural('Types de diplôme')
            ->setSearchFields(['id', 'name'])
            ->setPaginatorPageSize(30)
            ;
    }
}
