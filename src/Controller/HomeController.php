<?php

namespace App\Controller;

use App\Repository\AvisRepository;
use App\Repository\HorairesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(AvisRepository $avisRepository, 
    HorairesRepository $horairesRepository): Response
    {
        // Récupération de la liste des avis valides depuis le repository
        $listeAvisValides = $avisRepository->findBy(['valide' => true]);
        $horaires = $horairesRepository->findAll();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'listeAvisValides' => $listeAvisValides,
            'horaires' => $horaires,
        ]);
    }
}
