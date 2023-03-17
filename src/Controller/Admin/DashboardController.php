<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Centre;
use App\Entity\Diplome;
use App\Entity\Employe;
use App\Entity\Entreprise;
use App\Entity\BaseAutorisation;
use Doctrine\ORM\Query\Expr\Base;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {

        return $this->render('admin/dashboard.html.twig', [
        ]);

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('SOPCZ')
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToUrl('Retour au site', 'fas fa-home', '/');
        yield MenuItem::section('Gestion des données');
        yield MenuItem::linkToCrud('Entreprise', 'fas fa-industry', Entreprise::class);
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Centres', 'fas fa-building', Centre::class);
        yield MenuItem::linkToCrud('Employés', 'fas fa-users', Employe::class);
        yield MenuItem::linkToCrud('Diplomes', 'fas fa-envelope', Diplome::class);
        yield MenuItem::linkToCrud('Base de données', 'fas fa-database', BaseAutorisation::class);
    }
}
