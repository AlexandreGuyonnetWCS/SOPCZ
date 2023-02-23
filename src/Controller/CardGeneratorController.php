<?php

namespace App\Controller;

use App\Entity\Employe;
use App\Form\EmployeSearchType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CardGeneratorController extends AbstractController
{
    
    #[Route('/carte', name: 'app_card_generator')]
    public function index(): Response
    {   
        return $this->render('card_generator/index.html.twig', [
        ]);
    }  
}
    
    