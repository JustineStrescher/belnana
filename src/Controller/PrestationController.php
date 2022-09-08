<?php

namespace App\Controller;

use App\Classe\Search;
use App\Entity\Prestation;
use App\Form\SearchType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;





class PrestationController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) 
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/prestations', name: 'app_prestations')]

    public function index(Request $request): Response
    {

        $prestations = $this->entityManager->getRepository(Prestation::class)->findAll();

        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            //dd($search);
            $prestations= $this->entityManager->getRepository(Prestation::class)->findWithSearch($search);
        }
        
        return $this->render('prestation/index.html.twig',[
            'prestations' => $prestations,
            'form' =>$form->createView()
        ]);
    }
    #[Route('/prestation/{slug}', name: 'app_prestation')]
    public function show($slug): Response
    {$prestation = $this->entityManager->getRepository(Prestation::class)->findOneBySlug($slug);
        
        if(!$prestation){
            return $this->redirectToRoute('app_prestations');
        }
        return $this->render('prestation/show.html.twig',[
            'prestation' => $prestation
        ]);}
   
        
    }

   