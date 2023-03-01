<?php

namespace App\Controller;

use App\Form\EmployeSearchFormType;
use App\Repository\BaseAutorisationRepository;
use App\Repository\EmployeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EmployeSearchController extends AbstractController
{
    #[Route('/carte', name: 'index')]
    public function search(Request $request, EmployeRepository $employeRepository ,BaseAutorisationRepository $baseAutorisationRepository): Response
    {
        $form = $this->createForm(EmployeSearchFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $searchData = $form->getData();
            $employe = $searchData->getNom();

            // Recherchez les utilisateurs qui correspondent aux critères de recherche
            $employes = $employeRepository->findByNom($employe);
            $baseAutorisations = $baseAutorisationRepository->findByNom($employe);

            return $this->render('employe/search_results.html.twig', [
                'employes' => $employes,
                'baseAutorisations' => $baseAutorisations,

            ]);
        }

        return $this->render('card_generator/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}