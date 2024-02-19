<?php

namespace App\Controller;

use App\Entity\Voitures;
use App\Form\VoituresType;
use App\Repository\VoituresRepository;
use App\Repository\HorairesRepository; 
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/voitures')]
class VoituresController extends AbstractController
{
        #[Route('/', name: 'app_voitures_index', methods: ['GET'])]
        public function index(VoituresRepository $voituresRepository, HorairesRepository $horairesRepository): Response
        {
            // Utilisons $voituresRepository pour récupérer les voitures
            $voitures = $voituresRepository->findAll();
        
            // Utilisons $horairesRepository pour récupérer les horaires si nécessaire
            $horaires = $horairesRepository->findAll();
        
            return $this->render('services/voitures/index.html.twig', [
                'voitures' => $voitures,
                'horaires' => $horaires,
            ]);
        }
        
        
    #[Route('/new', name: 'app_voitures_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $voiture = new Voitures();
    
        // Récupérer l'ID de l'utilisateur actuel
        $user = $this->getUser();
    
        // Associons l'utilisateur connecté aux voitures
        $voiture->setUser($user);
    
        $form = $this->createForm(VoituresType::class, $voiture);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($voiture);
            $entityManager->flush();
    
            return $this->redirectToRoute('app_voitures_index', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->render('services/voitures/new.html.twig', [
            'voiture' => $voiture,
            'form' => $form->createView(),
        ]);
    }
    

    #[Route('/{id}', name: 'app_voitures_show', methods: ['GET'])]
    public function show(VoituresRepository $voituresRepository, int $id): Response
    {
        $voiture = $voituresRepository->find($id);
    
        if (!$voiture) {
            throw $this->createNotFoundException('Voiture not found');
        }
    
        // $imagesDirectory = $this->params->get('images_directory');

        return $this->render('services/voitures/show.html.twig', [
            'voiture' => $voiture,
            // 'imagesDirectory' => $imagesDirectory,
            'carImages' => [
                $voiture->getCar1(),
                $voiture->getCar2(),
                $voiture->getCar3(),
                $voiture->getCar4(),
                $voiture->getCar5(),
            ],
        ]);
    }
    
    



    #[Route('/{id}/edit', name: 'app_voitures_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Voitures $voiture, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VoituresType::class, $voiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            // $uploadedFiles = $form->get('images')->getData();

            return $this->redirectToRoute('app_voitures_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('services/voitures/edit.html.twig', [
            'voiture' => $voiture,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_voitures_delete', methods: ['POST'])]
    public function delete(Request $request, Voitures $voiture, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$voiture->getId(), $request->request->get('_token'))) {
            $entityManager->remove($voiture);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_voitures_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/search', name: 'app_search_voitures', methods: ['GET'])]
    public function search(Request $request, VoituresRepository $voituresRepository): Response
    {
        $marque = $request->query->get('marque');
        $prix = $request->query->get('prix');
        $energie = $request->query->get('energie');
        $kilometres = $request->query->get('kilometres');

        // Ajoutez une condition pour gérer le cas où tous les critères sont vides
        if (empty($marque) && empty($prix) && empty($energie) && empty($kilometres)) {
            return $this->render('services/voitures/search_results.html.twig', [
                'results' => [],
            ]);
        }

        $results = $voituresRepository->searchCars($marque, $prix, $energie, $kilometres);

        return $this->render('services/voitures/search_results.html.twig', [
            'results' => $results,
        ]);
    }
}