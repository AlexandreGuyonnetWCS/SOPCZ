<?php

namespace App\Controller\Admin;

use App\Entity\Diplome;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;

class DiplomeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Diplome::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [

            ChoiceField::new('type')->setChoices([
                'CACES' => 'CACES',
                'Habilitation' => 'Habilitation',
            ]),
            ChoiceField::new('nom')->setChoices([
                'R372' => 'R372',
                'R482' => 'R482',
                'R484' => 'R484',
                'R483' => 'R483',
                'R485' => 'R485',
                'R386' => 'R386',
                '486' => '486',
                'R489' => 'R489',
                'R490' => 'R490',
                'Habilitation électique basse tension' => 'Habilitation électique basse tension',
                'Habilitation électique haute tension' => 'Habilitation électique haute tension',
                'Echafaudage' => 'Echafaudage',
                'Habilitation électique' => 'Habilitation électique',
                'Travaux en hauteur' => 'Travaux en hauteur',
            ]),
            ChoiceField::new('categorie')->setChoices([
                'A' => 'A',
                'B1' => 'B1',
                'B2' => 'B2',
                'B3' => 'B3',
                'C1' => 'C1',
                'C2' => 'C2',
                'C3' => 'C3',
                'D' => 'D',
                'E' => 'E',
                'F' => 'F',
                'G' => 'G',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6',
                '7' => '7',
                '1A' => '1A',
                '1B' => '1B',
                '2A' => '2A',
                '2B' => '2B',
                'grues de chargement' => 'grues de chargement',
                'roulant' => 'roulant',
                'H0V' => 'H0V',
                'H1V' => 'H1V',
                'H2V' => 'H2V',
                'HC' => 'HC',
                'B0V' => 'B0V',
                'B1V' => 'B1V',
                'B2V' => 'B2V',
                'BC' => 'BC',
                'BR' => 'BR',
            ]),
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
            SlugField::new('template')
            ->setTargetFieldName('template')
            ->setRequired(false)
            ->setUnlockConfirmationMessage(
                'It is highly recommended to use the automatic slugs, but you can customize them'
            ),

        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Diplôme')
            ->setEntityLabelInPlural('Diplômes')
            ->setSearchFields(['nom', 'categorie', 'validite', 'description', 'image', 'type'])
            ->setDefaultSort(['type' => 'ASC'])
            ->setPaginatorPageSize(10);
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
