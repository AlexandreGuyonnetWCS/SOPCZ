<?php

namespace App\Controller;

use App\Service\PdfService;
use App\Form\EmployeSearchFormType;
use App\Repository\EntrepriseRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\BaseAutorisationRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class EmployeSearchController extends AbstractController
{
    private BaseAutorisationRepository $baseRepository;
    private EntrepriseRepository $entrepriseRepository;

    public function __construct(
        BaseAutorisationRepository $baseRepository,
        EntrepriseRepository $entrepriseRepository
    ) {
        $this->baseRepository = $baseRepository;
        $this->entrepriseRepository = $entrepriseRepository;
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

            // Recherchez les utilisateurs qui correspondent aux critères de recherche
            $diplomes = $this->baseRepository->getEmployeBaseInfo($employeNom, $employePrenom);
            return $this->render('employe/search_results.html.twig', [
                'datas' => $diplomes,
            ]);
        }

        return $this->render('card_generator/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('carte/{id}/pdf/', name: 'carte_pdf', methods: ['GET'])]

    public function cardToPdf(PdfService $pdfService, int $id): Response
    {
        $baseAutorisations = $this->baseRepository->findOneBy(['id' => $id]);
        $employe = $this->baseRepository->findOneBy(['id' => $id])->getEmploye()->getValues();
        $diplome = $this->baseRepository->findOneBy(['id' => $id])->getDiplome()->getValues();
        $entreprise = $this->entrepriseRepository->findAll();


        $html = $this->renderView('card_templates/carte.html.twig', [
            'employe' => $employe,
            'baseAutorisations' => $baseAutorisations,
            'diplome' => $diplome,
            'entreprise' => $entreprise,
        ]);

        $pdfService->showPdfFile($html);

        return new Response();
    }

    #[Route('carte/{id}/show', name: 'show', methods: ['GET'])]
    public function showCard(int $id): Response
    {

        $baseAutorisations = $this->baseRepository->findOneBy(['id' => $id]);
        $employe = $this->baseRepository->findOneBy(['id' => $id])->getEmploye()->getValues();
        $entreprise = $this->entrepriseRepository->findAll();


        return $this->render('card_templates/carte.html.twig', [
            'employe' => $employe,
            'baseAutorisations' => $baseAutorisations,
            'entreprise' => $entreprise,
        ]);
    }
}
