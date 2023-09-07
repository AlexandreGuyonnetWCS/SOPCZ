<?php

namespace App\Controller;

use App\Service\PdfService;
use App\Form\EmployeSearchFormType;
use App\Repository\EntrepriseRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\BaseAutorisationRepository;
use App\Repository\EmployeRepository;
use App\Repository\NumeroHabilitationRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EmployeSearchController extends AbstractController
{
    private BaseAutorisationRepository $baseRepository;
    private EntrepriseRepository $entrepriseRepository;
    private NumeroHabilitationRepository $numeroHabilitationRepository;
    private EmployeRepository $employeRepository;

    public function __construct(
        BaseAutorisationRepository $baseRepository,
        EntrepriseRepository $entrepriseRepository,
        NumeroHabilitationRepository $numeroHabilitationRepository,
        EmployeRepository $employeRepository
    ) {
        $this->baseRepository = $baseRepository;
        $this->entrepriseRepository = $entrepriseRepository;
        $this->numeroHabilitationRepository = $numeroHabilitationRepository;
        $this->employeRepository = $employeRepository;
    }
    #[Route('/carte', name: 'index')]
    public function search(Request $request): Response
    {
        $form = $this->createForm(EmployeSearchFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $searchData = $form->getData();
            $employeNom = $searchData->getNom();
            $employePrenom = $searchData->getPrenom();
            $datas = $this->baseRepository->getEmployeBaseInfo($employeNom, $employePrenom);
            $numero = $this->numeroHabilitationRepository->getNumberHabilitation($employeNom, $employePrenom);
            $employe = $this->employeRepository->findOneBy(['nom' => $employeNom, 'prenom' => $employePrenom]);

            return $this->render('employe/search_results.html.twig', [
                'datas' => $datas,
                'numero' => $numero,
                'form' => $form->createView(),
                'employe' => $employe,
            ]);
        }
        return $this->render('card_generator/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('carte/pdf/', name: 'carte_pdf', methods: ['GET'])]

    public function cardToPdf(PdfService $pdfService): Response
    {
        $nom = $_GET['nom'];
        $prenom = $_GET['prenom'];
        $type = $_GET['type'];
        $name = $_GET['name'];
        $datas = $this->baseRepository->getDiplomeByTypeName($type, $name, $nom, $prenom);
        $entreprise = $this->entrepriseRepository->findAll();
        $numero = $this->numeroHabilitationRepository->getNumberHabilitation($nom, $prenom);


        $html = $this->renderView('card_templates/carte.html.twig', [
            'type' => $type,
            'name' => $name,
            'nom' => $nom,
            'prenom' => $prenom,
            'entreprise' => $entreprise,
            'baseAutorisations' => $datas,
            'numero' => $numero,
        ]);

        $pdfService->generateBinaryPDF($html);

        return new Response();
    }

    #[Route('carte/show', name: 'show', methods: ['GET'])]
    public function showCard(): Response
    {
        $nom = $_GET['nom'];
        $prenom = $_GET['prenom'];
        $type = $_GET['type'];
        $name = $_GET['name'];
        $baseAutorisations = $this->baseRepository->getDiplomeByTypeName($type, $name, $nom, $prenom);
        $entreprise = $this->entrepriseRepository->findAll();
        $numero = $this->numeroHabilitationRepository->getNumberHabilitation($nom, $prenom);


        return $this->render('card_templates/carte.html.twig', [
            'baseAutorisations' => $baseAutorisations,
            'entreprise' => $entreprise,
            'type' => $type,
            'name' => $name,
            'nom' => $nom,
            'prenom' => $prenom,
            'numero' => $numero,
        ]);
    }
}
