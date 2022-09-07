<?php

namespace App\Controller;

use App\Entity\Prestation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

    public function index()
    {

        $prestations = $this->entityManager->getRepository(Prestation::class)->findAll();
        

        return $this->render('prestation/index.html.twig',
        [
            'prestations' => $prestations
        ]);
        
    }
}
