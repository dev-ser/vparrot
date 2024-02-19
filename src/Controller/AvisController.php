<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Form\AvisType;
use App\Repository\AvisRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class AvisController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/avis', name: 'app_avis', methods: ['GET', 'POST'])]
public function index(Request $request, AvisRepository $avisRepository): Response
{
    // Récupérer l'ID de l'utilisateur actuel s'il est connecté
    $userId = $this->getUser() ? $this->getUser()->getId() : null;

    $avis = new Avis();
    $form = $this->createForm(AvisType::class, $avis);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // On associe l'avis à l'utilisateur actuel s'il est connecté
        if ($this->getUser()) {
            $avis->setUser($this->getUser());
        }

        // Utilisation de Prepared Statements pour sécuriser les requêtes SQL
        $this->entityManager->persist($avis);
        $this->entityManager->flush();

        $this->addFlash('success', 'Nous avons bien reçu votre commentaire. Nous vous en remercions.');

        return $this->redirectToRoute('app_home');
    }

    $listeAvis = $avisRepository->findAll();

    return $this->render('services/avis/index.html.twig', [
        'form' => $form->createView(),
        'listeAvis' => $listeAvis,
    ]);
}


    #[Route('/avis/liste', name: 'app_avis_liste', methods: ['GET'])]
public function liste(Request $request, AvisRepository $avisRepository): Response
{
    // Ajout de la vérification du rôle utilisateur
    if (!$this->isGranted('ROLE_USER')) {
        return $this->redirectToRoute('access_denied');
    }

    // Récupérer tous les avis (valide ou non)
    $listeAvis = $avisRepository->findAll();

    return $this->render('services/avis/avis.html.twig', [
        'listeAvis' => $listeAvis,
    ]);
}


#[Route('/avis/{id}/update', name: 'app_update_avis', methods: ['POST'])]
public function updateAvis(Request $request, AvisRepository $avisRepository, EntityManagerInterface $entityManager, $id): JsonResponse
{
    $avis = $avisRepository->find($id);

    if (!$avis) {
        throw $this->createNotFoundException('Aucun avis trouvé pour cet identifiant: ' . $id);
    }

    // Récupérez la valeur envoyée depuis le front-end (1 ou 0)
    $estValide = $request->request->get('estValide');
    $avis->setValide($estValide == '1');

    $entityManager->persist($avis);
    $entityManager->flush();

    return new JsonResponse(['success' => true, 'valide' => $avis->getValide()]);
}

    #[Route('/avis/valides', name: 'app_avis_valides', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function listeValides(AvisRepository $avisRepository): Response
    {
        if (!$this->isGranted('ROLE_USER')) {
            return $this->redirectToRoute('access_denied');
        }

        // Récupérer les avis validés
        $listeAvisValides = $avisRepository->findBy(['valide' => true]);

        return $this->render('services/avis/avis_valides.html.twig', [
            'listeAvisValides' => $listeAvisValides,
            'listeAvis' => $listeAvisValides,
        ]);
    }

    #[Route('/avis/{id}/valider', name: 'app_avis_valider', methods: ['POST'])]
    public function valider(Request $request, AvisRepository $avisRepository, EntityManagerInterface $entityManager, $id): JsonResponse
    {
        $avis = $avisRepository->find($id);
    
        if (!$avis) {
            throw $this->createNotFoundException('Aucun avis trouvé pour cet identifiant: ' . $id);
        }
    
        $avis->setValide(true); 
    
        $entityManager->persist($avis);
        $entityManager->flush();
    
        return new JsonResponse(['success' => true, 'valide' => $avis->getValide()]);
    }
    


    #[Route('/avis/{id}/edit', name: 'app_avis_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Avis $avis, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AvisType::class, $avis);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_avis_liste');
        }

        return $this->render('services/avis/edit.html.twig', [
            'avis' => $avis,
            'form' => $form->createView(),
        ]);
    }

 
    #[Route('/avis/{id}', name: 'app_avis_delete', methods: ['POST'])]
    public function delete(Request $request, Avis $avis, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $avis->getId(), $request->request->get('_token'))) {
            $entityManager->remove($avis);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_avis_liste');
    }
}

