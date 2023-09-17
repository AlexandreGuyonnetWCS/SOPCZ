<?php

namespace App\Controller\Admin;

use App\Entity\Document;
use App\Controller\Admin\EmployeCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\FileUploadType;

class DocumentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Document::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            ImageField::new('name', 'Nom du document')
            ->setFormType(FileUploadType::class)
            ->setFormTypeOptions([
                'attr' => [
                    'accept' => 'application/pdf'
                ]
            ])
            ->setBasePath('uploads/employes/')
            ->setUploadDir('public/uploads/employes/')
            ->setUploadedFileNamePattern('[name].[extension]')
            ->hideOnIndex(),
            TextField::new('name', 'Nom du document')
            ->setTemplatePath('admin/document_link.html.twig')
            ->onlyOnIndex(),
            AssociationField::new('employe')
            ->setLabel('Nom et prénom')
            ->setCrudController(EmployeCrudController::class),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Documents')
            ->setPageTitle('new', 'Ajouter un document')
            ->setPageTitle('edit', 'Modifier un document')
            ->setPageTitle('detail', 'Détails du document')
            ->setSearchFields(['name', 'employe.nom', 'employe.prenom'])
            // afficher le nom de l'image dans la liste
            ->setFormOptions(['allow_extra_fields' => true])
            ->setDefaultSort(['id' => 'DESC']);
    }
}
