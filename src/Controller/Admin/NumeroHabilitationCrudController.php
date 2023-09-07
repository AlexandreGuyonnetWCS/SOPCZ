<?php

namespace App\Controller\Admin;

use App\Entity\NumeroHabilitation;
use App\Controller\Admin\CentreCrudController;
use App\Controller\Admin\EmployeCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class NumeroHabilitationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return NumeroHabilitation::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('number')
            ->setLabel('Numéro d\'habilitation'),
            AssociationField::new('employe')
            ->setLabel('Nom et prénom')
            ->setCrudController(EmployeCrudController::class),
            AssociationField::new('centre')
            ->setCrudController(CentreCrudController::class)
            ->formatValue(function ($value, $entity) {
                return implode(",", $entity->getCentre()->toArray());
            })
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Numéro d\'habilitation')
            ->setEntityLabelInPlural('Numéros d\'habilitation')
            ->setSearchFields(
                [
                    'employe.nom',
                    'employe.prenom',
                    'centre.nom',
                ]
            )
            ->setDefaultSort(['employe.nom' => 'DESC'])
            ->setPaginatorPageSize(30)
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des %entity_label_plural%')
            ->setPageTitle(Crud::PAGE_DETAIL, 'Détail de l\'%entity_label_singular%')
            ->setPageTitle(Crud::PAGE_NEW, 'Création d\'une %entity_label_singular%')
            ->setPageTitle(Crud::PAGE_EDIT, 'Modification de l\'%entity_label_singular%');
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, 'detail')
            ->update(Crud::PAGE_INDEX, 'detail', function (Action $action) {
                return $action->setIcon('fa fa-eye')->setLabel('voir')->setCssClass('text-info');
            })
            ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
                return $action->setIcon('fa fa-edit')->setLabel('modifier')->addCssClass('text-warning');
            })
            ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action) {
                return $action->setIcon('fa fa-trash')->setLabel('supprimer');
            })
            ->update(Crud::PAGE_DETAIL, Action::DELETE, function (Action $action) {
                return $action->setIcon('fa fa-trash')->setLabel('supprimer')
                    ->setCssClass('btn btn-danger');
            })
            ->update(Crud::PAGE_DETAIL, Action::EDIT, function (Action $action) {
                return $action->setIcon('fa fa-edit')->setLabel('modifier')->addCssClass('btn btn-warning');
            })
            ->update(Crud::PAGE_DETAIL, Action::INDEX, function (Action $action) {
                return $action->setIcon('fa fa-arrow-left')->setLabel('retour');
            });
    }
}
