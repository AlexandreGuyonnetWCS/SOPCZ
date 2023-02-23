<?php

namespace App\Controller\Admin;

use App\Entity\BaseAutorisation;
use App\Controller\Admin\CentreCrudController;
use App\Controller\Admin\DiplomeCrudController;
use App\Controller\Admin\EmployeCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class BaseAutorisationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BaseAutorisation::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('Employe')
            ->setLabel('Nom et prénom')
            ->setCrudController(EmployeCrudController::class)
            ->formatValue(function ($value, $entity) {
                return implode(",",$entity->getEmploye()->toArray());})
            ->setFormTypeOption('choice_label', function ($employe) {
                return $employe->getNom() . ' ' . $employe->getPrenom()
            ;
            }),
            AssociationField::new('Diplome')
            ->setCrudController(DiplomeCrudController::class)
            ->formatValue(function ($value, $entity) {
                return implode(",",$entity->getDiplome()->toArray());})
            ->setFormTypeOption('choice_label', function ($diplome) {
                return $diplome->getType() . ' ' . $diplome->getNom() . ' ' . $diplome->getCategorie();
            }),

            AssociationField::new('Centre')
            ->setCrudController(CentreCrudController::class)
            ->formatValue(function ($value, $entity) {
                return implode(",",$entity->getCentre()->toArray());})
            ->setFormTypeOption('choice_label', function ($centre) {
                return $centre->getNom();
            }),
            DateField::new('CreatedAt')
            ->setFormat('dd/MM/yyyy')
            ->setHelp('Date de création de l\'autorisation')
            ->setLabel('Date de création'),
            DateField::new('EndedAt')
            ->setFormat('dd/MM/yyyy')
            ->setHelp('Date de fin de l\'autorisation')
            ->setLabel('Date de fin'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Autorisation')
            ->setEntityLabelInPlural('Autorisations')
            ->setSearchFields(['id', 'Employe.nom', 'Employe.prenom', 'Diplome.nom', 'Diplome.type', 'Diplome.categorie', 'Centre.nom', 'CreatedAt', 'EndedAt'])
            ->setDefaultSort(['CreatedAt' => 'DESC'])
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