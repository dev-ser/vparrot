<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\HorairesRepository;

class EmployesController extends AbstractController
{
    #[Route('/employes', name: 'app_employes')]
    public function index(Request $request, HorairesRepository $horairesRepository): Response
    {
         // On récupére la session 
         $session = $request->getSession();

        // On désactive l'utilisation des entités XML externes
        libxml_disable_entity_loader(true);

        // On défini une limite de profondeur de l'arborescence XML
        libxml_set_streams_context(stream_context_create([
            'xml' => [
                'max_depth' => 1,
            ],
        ]));

        // Appel de la méthode du repository HorairesRepository pour récupérer les horaires
        $horaires = $horairesRepository->findAll();  
        
        return $this->render('employes/index.html.twig', [
            'controller_name' => 'EmployesController', 
            'horaires' => $horaires,
            'session' => $session,
        ]);
    }
    public function logout(SessionInterface $session): Response
{
    // On détruit la session
    $session->invalidate();

    return $this->redirectToRoute('app_home'); 
}
}

