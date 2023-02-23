<?php

namespace App\Controller\Admin;

use App\Entity\Centre;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CentreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Centre::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            TextField::new('adresse'),
            IntegerField::new('codePostal'),
            TextField::new('ville'),
            TextField::new('telephone'),
            TextField::new('mail'),
        ];
    }
}
