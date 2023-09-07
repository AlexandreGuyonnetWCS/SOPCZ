<?php

namespace App\Controller;

use App\Repository\EntrepriseRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    private $entreprise = EntrepriseRepository::class;

    public function __construct(EntrepriseRepository $entreprise)
    {
        $this->entreprise = $entreprise;
    }

    #[Route('/login', name: 'app_login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        $entreprise = $this->entreprise->findAll();

        return $this->render('login/index.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            'entreprise' => $entreprise,
        ]);
    }
}
