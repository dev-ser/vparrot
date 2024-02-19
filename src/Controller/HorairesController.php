<?php

namespace App\Controller;

use App\Entity\Horaires;
use App\Form\HorairesType;
use App\Repository\HorairesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class HorairesController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/horaires', name: 'app_horaires_index', methods: ['GET'])]
    public function index(HorairesRepository $horairesRepository): Response
    {
        $horaires = $horairesRepository->findAll();

        return $this->render('services/horaires/index.html.twig', [
            'horaires' => $horaires,
        ]);
    }

    #[Route('/new', name: 'app_horaires_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $horaires = new Horaires();
    
        // Récupérons l'ID de l'utilisateur actuel
        $user = $this->getUser();
    
        // Associons l'utilisateur connecté aux horaires
        $horaires->setUser($user);
    
        $form = $this->createForm(HorairesType::class, $horaires);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            // Vérifions si l'utilisateur est connecté avant de récupérer l'ID
            if ($this->getUser()) {
    
                $this->entityManager->persist($horaires);
                $this->entityManager->flush();
    
                // Condition de redirection en fonction du rôle
                if ($this->isGranted('ROLE_ADMIN')) {
                    return $this->redirectToRoute('app_admin');
                } elseif ($this->isGranted('ROLE_USER')) {
                    return $this->redirectToRoute('app_employes');
                }
            }
    
            // Autre redirection par défaut si aucun des rôles n'est présent
            return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->render('services/horaires/new.html.twig', [
            'horaires' => $horaires,
            'form' => $form->createView(),
        ]);
    }
    
    

    #[Route('/horaires/{id}', name: 'app_horaires_show', methods: ['GET'])]
    public function show(HorairesRepository $horairesRepository, int $id): Response
    {
        $horaires = $horairesRepository->find($id);

        if (!$horaires) {
            throw $this->createNotFoundException('Horaires not found');
        }

        return $this->render('services/horaires/show.html.twig', [
            'horaires' => $horaires,
        ]);
    }

    #[Route('/horaires/{id}/edit', name: 'app_horaires_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Horaires $horaires): Response
    {
        $form = $this->createForm(HorairesType::class, $horaires);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            // Debugging: Vider l'objet horaires avant de vider
            dump($horaires);
            $this->entityManager->flush(); 
    
            if ($this->isGranted('ROLE_ADMIN')) {
                return $this->redirectToRoute('app_admin');
            } else {
                return $this->redirectToRoute('app_employes');
            }
        } else {
            // Debugging: Voir les erreurs
            dump($form->getErrors(true, true));
        }
    
        return $this->render('services/horaires/edit.html.twig', [
            'horaires' => $horaires,
            'form' => $form->createView(),
        ]);
    }
    

    #[Route('/horaires/{id}', name: 'app_horaires_delete', methods: ['POST'])]
    public function delete(Request $request, Horaires $horaires): Response
    {
        if (!$horaires) {
            throw $this->createNotFoundException('Horaires not found');
        }

        if ($this->isCsrfTokenValid('delete'.$horaires->getId(), $request->request->get('_token'))) {
            $this->entityManager->remove($horaires);
            $this->entityManager->flush();
        }

        if ($this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('app_admin');
        } else {
            return $this->redirectToRoute('app_employes');
        }
    }
}
