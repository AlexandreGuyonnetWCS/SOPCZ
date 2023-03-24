<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\PasswordResetType;
use App\Repository\UserRepository;
use Symfony\Component\Form\FormEvents;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Symfony\Component\Form\FormBuilderInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use Symfony\Component\Validator\Constraints\Regex;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use Symfony\Component\Validator\Constraints\Length;
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

    private UserPasswordHasherInterface $userPasswordHasher;
    private MailerInterface $mailer;
    private ManagerRegistry $doctrine;

    public function __construct(
        UserPasswordHasherInterface $userPasswordHasher,
        MailerInterface $mailer,
        ManagerRegistry $doctrine
    ) {
        $this->userPasswordHasher = $userPasswordHasher;
        $this->mailer = $mailer;
        $this->doctrine = $doctrine;
    }

    public function configureFields(string $pageName): iterable
    {
        $fields = [
            IdField::new('id')->hideOnForm(),
            EmailField::new('email'),
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
                    'first_options' => [
                        'label' => 'Mot de passe', 'attr' => ['placeholder' => 'Mot de passe',
                        'value' => 'Creation17!'],
                        'help' => 'Le mot de passe par défaut est "Creation17!"'
                    ],
                    'second_options' => [
                        'label' => 'Répéter le mot de passe',
                        'attr' => ['placeholder' => 'Répéter le mot de passe',
                        'value' => 'Creation17!']],
                    'mapped' => false,
                    'constraints' => [
                        new Length([
                            'min' => 8,
                            'minMessage' => 'Le mot de passe doit contenir au moins 8 caractères',
                            'max' => 25,
                        ]),
                        new Regex([
                            'pattern' => "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[-+_!@#$%^&*., ?]).+$/",
                            'message' => "Le mot de passe doit contenir au moins une majuscule,
                                une minuscule, un chiffre et un caractère spécial"
                        ]),
                    ],
                ])
                ->setRequired($pageName === Crud::PAGE_NEW)
                ->onlyOnForms()
                ->addCssClass('password-field')
                ];
        $fields[] = $password;
        return $fields;
    }

    public function configureActions(Actions $actions): Actions
    {
        $sendEmail = Action::new('sendEmail', 'Envoyer un email de vérification', 'fas fa-envelope')
            ->linkToCrudAction('sendEmail')
            ->displayIf(fn (User $user) => $user->getIsVerified())
            ->addCssClass('btn btn-primary');
        $sendResetPassword = Action::new(
            'sendMailResetPassword',
            'Envoyer un email de réinitialisation de mot de passe',
            'fas fa-envelope'
        )
            ->linkToCrudAction('sendMailResetPassword')
            ->displayIf(fn (User $user) => !$user->getIsVerified())
            ->addCssClass('btn btn-primary');
        return $actions
            ->add(Crud::PAGE_EDIT, $sendEmail)
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->add(Crud::PAGE_EDIT, $sendResetPassword)
            ->add(Crud::PAGE_EDIT, Action::DETAIL);
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Liste des utilisateurs')
            ->setPageTitle('detail', 'Détail de l\'utilisateur')
            ->setPageTitle('new', 'Ajouter un utilisateur')
            ->setPageTitle('edit', 'Modifier l\'utilisateur');
    }

    private function hashPassword(): callable
    {
        return function ($event) {
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

    public function createNewFormBuilder(
        EntityDto $entityDto,
        KeyValueStore $formOptions,
        AdminContext $context
    ): FormBuilderInterface {
        $formBuilder = parent::createNewFormBuilder($entityDto, $formOptions, $context);
        return $this->addPasswordEventListener($formBuilder);
    }

    public function createEditFormBuilder(
        EntityDto $entityDto,
        KeyValueStore $formOptions,
        AdminContext $context
    ): FormBuilderInterface {
        $formBuilder = parent::createEditFormBuilder($entityDto, $formOptions, $context);
        return $this->addPasswordEventListener($formBuilder);
    }

    private function addPasswordEventListener(FormBuilderInterface $formBuilder): FormBuilderInterface
    {
        return $formBuilder->addEventListener(FormEvents::POST_SUBMIT, $this->hashPassword());
    }

    public function createEntity(string $entityFqcn): User
    {
        $user = new User();
        $user->generateEmailVerificationToken();

        return $user;
    }

    public function updateEntity(EntityManagerInterface $entityManager, mixed $entityInstance): void
    {
        $user = $entityInstance;
        if ($user instanceof User) {
            $user->generateEmailVerificationToken();
        }

        parent::updateEntity($entityManager, $entityInstance);
    }


    private function sendEmailVerification(User $user): void
    {
        $email = (new TemplatedEmail())
            ->from('admin@example.com')
            ->to($user->getEmail())
            ->subject('Verify your email address')
            ->htmlTemplate('emails/user_verification.html.twig')
            ->context([
                'user' => $user,
            ]);

        $this->mailer->send($email);
    }

    private function sendEmailResetPassword(User $user): void
    {
        $email = (new TemplatedEmail())
            ->from('admin@example.com')
            ->to($user->getEmail())
            ->subject('Reset your password')
            ->htmlTemplate('emails/user_reset_password.html.twig')
            ->context([
                'user' => $user,
            ]);

        $this->mailer->send($email);
    }

    public function sendEmail(AdminContext $context, UserRepository $user): Response
    {
        $id = $context->getRequest()->query->get('entityId');
        $user = $user->find($id);
        $this->sendEmailVerification($user);

        $this->addFlash('success', 'Un email de vérification a été envoyé à l\'utilisateur.');

        return $this->redirectToRoute('admin', [
            'crudAction' => 'edit',
            'entityId' => $id,
        ]);
    }

    public function sendMailResetPassword(AdminContext $context, UserRepository $user): Response
    {
        $id = $context->getRequest()->query->get('entityId');
        $user = $user->find($id);
        $this->sendEmailResetPassword($user);

        $this->addFlash('success', 'Un email de réinitialisation de mot de passe a été envoyé à l\'utilisateur.');

        return $this->redirectToRoute('admin', [
            'crudAction' => 'edit',
            'entityId' => $id,
        ]);
    }

    #[Route("/verify-email/{token}", name: "app_user_verify_email")]
    public function verifyUserEmail(string $token, UserRepository $userRepository): Response
    {
        $user = $userRepository->findOneBy(['emailToken' => $token]);
        if (!$user) {
            throw $this->createNotFoundException('Pas d\'utilisateur trouvé avec ce token.');
        }

        $user->setIsVerified(true);
        $this->doctrine->getManager()->flush();

        $this->addFlash('success', 'Votre adresse email a été vérifiée.');

        return $this->redirectToRoute('home');
    }

    #[Route("/reset-password/{token}", name: "app_user_reset_password")]
    public function resetPassword(
        Request $request,
        UserRepository $userRepository,
        UserPasswordHasherInterface $hasher,
        string $token
    ): Response {
        $user = $userRepository->findOneBy(['emailToken' => $token]);
        $form = $this->createForm(PasswordResetType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($hasher->hashPassword($user, $form->get('password')->getData()));

            $userRepository->save($user, true);
            $this->addFlash('success', 'Votre mot de passe a été réinitialisé.');

            return $this->redirectToRoute('home');
        }
        return $this->render('user/reset_password.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
        ]);
    }
}
