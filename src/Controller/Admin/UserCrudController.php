<?php

namespace App\Controller\Admin;

use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Length;
use App\Entity\User;
use Symfony\Component\Form\FormEvents;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Symfony\Component\Form\FormBuilderInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Config\KeyValueStore;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function __construct(public UserPasswordHasherInterface $userPasswordHasher) {

    }

    public function configureFields(string $pageName): iterable
    {  
        $fields = [
            IdField::new('id')->hideOnForm(),
            EmailField::new('email'),
        ];

        return [
        TextField::new('nom')
            ->setFormTypeOption(
                'constraints',
                [
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Le nom doit contenir au moins 2 caractères',
                        'max' => 255,
                    ]),
                    new Regex([
                        'pattern' => "/^[a-zA-Z]+$/",
                        'message' => "Le nom '{{ value }}' n'est pas valide."
                    ])
                ]
            ),
        TextField::new('prenom')
            ->setFormTypeOption(
                'constraints',
                [
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Le prénom doit contenir au moins 2 caractères',
                        'max' => 255,
                    ]),
                    new Regex([
                        'pattern' => "/^[a-zA-Z]+$/",
                        'message' => "Le prénom '{{ value }}' n'est pas valide."
                    ])
                ]
            ),
        EmailField::new('email')
            ->setFormTypeOption(
                'constraints',
                [
                    new Regex([
                        'pattern' => "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$/",
                        'message' => "L\'email '{{ value }}' n'est pas valide."
                    ])
                ]
            ),
        ChoiceField::new('roles')
                    ->allowMultipleChoices()
                    ->setChoices([
                        'ROLE_USER' => 'ROLE_USER',
                        'ROLE_ADMIN' => 'ROLE_ADMIN',
                    ]),
        $password = TextField::new('password')
                    ->setFormType(RepeatedType::class)
                    ->setFormTypeOptions([
                        'type' => PasswordType::class,
                        'first_options' => ['label' => 'Mot de passe'],
                        'second_options' => ['label' => 'Répéter le mot de passe'],
                        'mapped' => false,
                        'constraints' => [
                            new Length([
                                'min' => 8,
                                'minMessage' => 'Le mot de passe doit contenir au moins 8 caractères',
                                'max' => 25,
                            ]),
                            new Regex([
                                'pattern' => "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[-+_!@#$%^&*., ?]).+$/",
                                'message' => "Le mot de passe doit contenir au moins une majuscule, une minuscule, un chiffre et un caractère spécial"
                            ])
                        ],
                    ])
                    ->setRequired($pageName === Crud::PAGE_NEW)
                    ->onlyOnForms()
                    ->addCssClass('password-field'),  ];
                $fields[] = $password;
        
                return $fields;            
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
        ->add(Crud::PAGE_EDIT, Action::INDEX)
        ->add(Crud::PAGE_INDEX, Action::DETAIL)
        ->add(Crud::PAGE_EDIT, Action::DETAIL)
        ;
            
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Liste des utilisateurs')
            ->setPageTitle('detail', 'Détail de l\'utilisateur')
            ->setPageTitle('new', 'Ajouter un utilisateur')
            ->setPageTitle('edit', 'Modifier l\'utilisateur');
    }

    private function hashPassword() {
        return function($event) {
            $form = $event->getForm();
            if (!$form->isValid()) {
                return;
            }
            $password = $form->get('password')->getData();
            if ($password === null) {
                return;
            }

            $hash = $this->userPasswordHasher->hashPassword(new User(), $password);
            $form->getData()->setPassword($hash);
        };
    }

    public function createNewFormBuilder(EntityDto $entityDto, KeyValueStore $formOptions, AdminContext $context): FormBuilderInterface
    {
        $formBuilder = parent::createNewFormBuilder($entityDto, $formOptions, $context);
        return $this->addPasswordEventListener($formBuilder);
    }

    public function createEditFormBuilder(EntityDto $entityDto, KeyValueStore $formOptions, AdminContext $context): FormBuilderInterface
    {
        $formBuilder = parent::createEditFormBuilder($entityDto, $formOptions, $context);
        return $this->addPasswordEventListener($formBuilder);
    }

    private function addPasswordEventListener(FormBuilderInterface $formBuilder): FormBuilderInterface
    {
        return $formBuilder->addEventListener(FormEvents::POST_SUBMIT, $this->hashPassword());
    }
}
