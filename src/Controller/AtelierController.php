<?php

namespace App\Controller;

use App\Repository\HorairesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AtelierController extends AbstractController
{
    #[Route('/atelier', name: 'app_atelier')]
    public function index(HorairesRepository $horairesRepository): Response
    {
        // On utilise $horairesRepository pour récupérer les horaires si nécessaire
        $horaires = $horairesRepository->findAll();

        return $this->render('services/atelier/index.html.twig', [
            'controller_name' => 'AtelierController',
            'horaires' => $horaires, 
        ]);
    }
}
