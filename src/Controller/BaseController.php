<?php

namespace App\Controller;

use App\Form\DiplomesType;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\BaseAutorisationRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\NumeroHabilitationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BaseController extends AbstractController
{
    private BaseAutorisationRepository $baseRepository;
    private NumeroHabilitationRepository $numeroHabilitationRepository;

    public function __construct(
        BaseAutorisationRepository $baseRepository,
        NumeroHabilitationRepository $numeroHabilitationRepository
    ) {
        $this->baseRepository = $baseRepository;
        $this->numeroHabilitationRepository = $numeroHabilitationRepository;
    }

    #[Route('/base', name: 'app_base')]
    public function index(): Response
    {
        return $this->render('base/index.html.twig', [
            'controller_name' => 'BaseController',
        ]);
    }

    #[Route('/base_search', name: 'base_search')]
    public function search(Request $request): Response
    {
        $nom = $_POST['employe_search_form']['nom'] ?? $_POST['nom'];
        $prenom = $_POST['employe_search_form']['prenom'] ?? $_POST['prenom'];
        $datas = $this->baseRepository->getEmployeBaseInfo($nom, $prenom);
        $numero = $this->numeroHabilitationRepository->getNumberHabilitation($nom, $prenom);
        $form = $this->createForm(DiplomesType::class, null, [
            'datas' => $datas,
            'numero' => $numero,
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $searchData = $form->getData();
            $diplomeType = $searchData->getDiplomeType();
            $diplomeName = $searchData->getDiplomeName();

            // Recherchez les diplomes qui correspondent aux critères de recherche
            $datas = $this->baseRepository->getDiplomeByTypeName($diplomeType, $diplomeName, $nom, $prenom);
            $numero = $this->numeroHabilitationRepository->getNumberHabilitation($nom, $prenom);
            return $this->render('base/index.html.twig', [
                'datas' => $datas,
                'numero' => $numero,
            ]);
        }
        return $this->render('base/search_results.html.twig', [
            'form' => $form->createView(),
            'nom' => $nom,
            'prenom' => $prenom,
            'datas' => $datas,
            'numero' => $numero,
        ]);
    }
}
