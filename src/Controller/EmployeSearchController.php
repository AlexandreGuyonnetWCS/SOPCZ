<?php

namespace App\Controller;

use App\Entity\DiplomeFull;
use App\Service\PdfService;
use App\Form\EmployeSearchFormType;
use App\Repository\DiplomeRepository;
use App\Repository\EmployeRepository;
use App\Repository\EntrepriseRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\BaseAutorisationRepository;
use App\Repository\DiplomeFullRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class EmployeSearchController extends AbstractController
{
    #[Route('/carte', name: 'index')]
    public function search(
        Request $request,
        EmployeRepository $employeRepository,
        BaseAutorisationRepository $baseRepository,
    ): Response {
        $form = $this->createForm(EmployeSearchFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $searchData = $form->getData();
            $employeNom = $searchData->getNom();
            $employePrenom = $searchData->getPrenom();

            // Recherchez les utilisateurs qui correspondent aux critères de recherche
            $employe = $employeRepository->findBy(['nom' => $employeNom, 'prenom' => $employePrenom]);
            $baseAutorisations = $baseRepository->findByNomEtPrenom($employeNom, $employePrenom);

            return $this->render('employe/search_results.html.twig', [
                'employe' => $employe,
                'baseAutorisations' => $baseAutorisations,
            ]);
        }

        return $this->render('card_generator/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('carte/{id}/pdf/', name: 'carte_pdf', methods: ['GET'])]

    public function cardToPdf(
        BaseAutorisationRepository $baseRepository,
        EntrepriseRepository $entrepriseRepository,
        PdfService $pdfService,
        int $id
    ): Response {
        $baseAutorisations = $baseRepository->findOneBy(['id' => $id]);
        $employe = $baseRepository->findOneBy(['id' => $id])->getEmploye()->getValues();
        $diplome = $baseRepository->findOneBy(['id' => $id])->getDiplome()->getValues();
        $entreprise = $entrepriseRepository->findAll();


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
    public function showCard(
        DiplomeRepository $diplomeRepository,
        BaseAutorisationRepository $baseRepository,
        EntrepriseRepository $entrepriseRepository,
        int $id
    ): Response {

        $baseAutorisations = $baseRepository->findOneBy(['id' => $id]);
        $employe = $baseRepository->findOneBy(['id' => $id])->getEmploye()->getValues();
        $diplome = $baseRepository->findOneBy(['id' => $id])->getDiplome()->getValues();
        $entreprise = $entrepriseRepository->findAll();
        $diplomeRepository->findOneBy(['id' => $diplome])->getDiplomeFull();

        return $this->render('card_templates/carte.html.twig', [
            'employe' => $employe,
            'baseAutorisations' => $baseAutorisations,
            'diplome' => $diplome,
            'entreprise' => $entreprise,
        ]);
    }
}
