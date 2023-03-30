<?php

namespace App\Controller\Admin;

use App\Entity\Diplome;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class DiplomeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Diplome::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('description'),
            ChoiceField::new('validite')->setChoices([
                '1' => '1 an',
                '2' => '2 ans',
                '3' => '3 ans',
                '5' => '5 ans',
                '10' => '10 ans',
            ]),
            ImageField::new('image')
            ->setBasePath('uploads/images')
            ->setUploadDir('public/uploads/images')
            ->setUploadedFileNamePattern('[randomhash].[extension]')
            ->setRequired(false),
            // SlugField::new('template')
            // ->setTargetFieldName('template')
            // ->setRequired(false)
            // ->setUnlockConfirmationMessage(
            //     'It is highly recommended to use the automatic slugs, but you can customize them'
            // ),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Diplôme')
            ->setEntityLabelInPlural('Diplômes');
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setIcon('fa fa-plus');
            })
            ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
                return $action->setIcon('fa fa-pen');
            })
            ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action) {
                return $action->setIcon('fa fa-trash');
            })
            ->update(Crud::PAGE_INDEX, Action::DETAIL, function (Action $action) {
                return $action->setIcon('fa fa-eye');
            })
            ->update(Crud::PAGE_INDEX, Action::BATCH_DELETE, function (Action $action) {
                return $action->setIcon('fa fa-trash');
            });
    }
}
