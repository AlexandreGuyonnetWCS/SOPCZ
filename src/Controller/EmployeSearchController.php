<?php

namespace App\Controller;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Repository\UserRepository;
use App\Form\EmployeSearchFormType;
use App\Repository\EmployeRepository;
use App\Repository\EntrepriseRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\BaseAutorisationRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\NumeroHabilitationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EmployeSearchController extends AbstractController
{
    private BaseAutorisationRepository $baseRepository;
    private EntrepriseRepository $entrepriseRepository;
    private NumeroHabilitationRepository $numeroHabilitationRepository;
    private EmployeRepository $employeRepository;
    private Dompdf $dompdf;
    private UserRepository $userRepository;

    public function __construct(
        BaseAutorisationRepository $baseRepository,
        EntrepriseRepository $entrepriseRepository,
        NumeroHabilitationRepository $numeroHabilitationRepository,
        EmployeRepository $employeRepository,
        UserRepository $userRepository
    ) {
        $this->baseRepository = $baseRepository;
        $this->entrepriseRepository = $entrepriseRepository;
        $this->numeroHabilitationRepository = $numeroHabilitationRepository;
        $this->employeRepository = $employeRepository;
        $this->userRepository = $userRepository;
    }

    #[Route('/carte', name: 'index')]
    public function search(Request $request): Response
    {   
        $_SESSION['user'] = $this->getUser();
        $roles = $_SESSION['user']->getRoles()[0];

        if ($roles !== 'ROLE_EMPLOYE') {
        $form = $this->createForm(EmployeSearchFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $searchData = $form->getData();
            $employeNom = $searchData->getNom();
            $employePrenom = $searchData->getPrenom();
            $datas = $this->baseRepository->getEmployeBaseInfo($employeNom, $employePrenom);
            $numero = $this->numeroHabilitationRepository->getNumberHabilitation($employeNom, $employePrenom);
            $employe = $this->employeRepository->findOneBy(['nom' => $employeNom, 'prenom' => $employePrenom]);
            try {
                $departement = $employe->getDepartement();
            } catch (\Throwable $th) {
                return $this->render('employe/no_search_results.html.twig');
            }
            $departement = $employe->getDepartement();
            $user = $this->getUser();
            $userDepartement = array($this->userRepository->findDepartement($user));
        if (in_array($departement, $userDepartement[0]) ) {
                return $this->render('employe/search_results.html.twig', [
                    'datas' => $datas,
                    'numero' => $numero,
                    'form' => $form->createView(),
                    'employe' => $employe,
                ]);
            } else {
            return $this->render('employe/search_results_no_departement.html.twig'); 
        }
        }
        return $this->render('card_generator/index.html.twig', [
            'form' => $form->createView(),
        ]);
    } else {
        $_SESSION['user'] = $this->getUser();
        $employeNom = $_SESSION['user']->getNom();
        $employePrenom = $_SESSION['user']->getPrenom();
        $datas = $this->baseRepository->getEmployeBaseInfo($employeNom, $employePrenom);
        $numero = $this->numeroHabilitationRepository->getNumberHabilitation($employeNom, $employePrenom);
        $employe = $this->employeRepository->findOneBy(['nom' => $employeNom, 'prenom' => $employePrenom]);
        $departement = $employe->getDepartement();

        
    return $this->render('employe/employe_view.html.twig', [
        'departement' => $departement,
        'numero' => $numero,
        'employe' => $employe,
        'datas' => $datas,
    ]);

}
    }

    #[Route('carte/pdf/', name: 'carte_pdf', methods: ['GET'])]

    public function cardToPdf(): void
    {
        $id = uniqid();
        $nom = $_GET['nom'];
        $prenom = $_GET['prenom'];
        $type = $_GET['type'];
        $name = $_GET['name'];
        $datas = $this->baseRepository->getDiplomeByTypeName($type, $name, $nom, $prenom);
        $entreprise = $this->entrepriseRepository->findAll();
        $numero = $this->numeroHabilitationRepository->getNumberHabilitation($nom, $prenom);

        $html = $this->renderView('card_templates/cartepdf.html.twig', [
            'type' => $type,
            'name' => $name,
            'nom' => $nom,
            'prenom' => $prenom,
            'entreprise' => $entreprise,
            'baseAutorisations' => $datas,
            'numero' => $numero,

        ]);
        $path = $this->getParameter('kernel.project_dir') . '/public/uploads/';
        $data = realpath($path);
        $pdfOptions = new Options();
        $pdfOptions->setIsRemoteEnabled(true);
        $pdfOptions->setChroot($data);

        $this->dompdf = new Dompdf($pdfOptions);
        $this->dompdf->loadHtml($html);
        $this->dompdf->render();
        $this->dompdf->stream($id . "-carte.pdf", [
            "Attachment" => true
        ]);
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
