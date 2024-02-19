<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ContactController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/contact', name: 'app_contact_index', methods: ['GET', 'POST'])]
    public function index(Request $request): Response
    {
        // Création d'une nouvelle instance de l'entité Contact
        $contact = new Contact();
    
        // Récupération de l'ID de l'utilisateur actuel s'il est connecté
        $userId = $this->getUser() ? $this->getUser()->getId() : null;
    
        // Création du formulaire à partir de ContactType
        $form = $this->createForm(ContactType::class, $contact);
    
        // Gestion de la soumission du formulaire
        $form->handleRequest($request);
    
        // Si le formulaire est soumis et valide, on enregistre le contact dans la base de données
        if ($form->isSubmitted() && $form->isValid()) {
            // On associe l'avis à l'utilisateur actuel s'il est connecté
            if ($this->getUser()) {
                $contact->setUser($this->getUser());
            }
    
            // Utilisation directe de l'EntityManager injecté
            $entityManager = $this->entityManager;
    
            // On persiste et flush pour sauvegarder l'entité dans la base de données
            $entityManager->persist($contact);
            $entityManager->flush();
    
            // Redirection vers la page d'accueil après soumission réussie
            return $this->redirectToRoute('app_home');
        }
    
        // Affichage du formulaire s'il n'a pas été soumis ou s'il y a des erreurs
        return $this->render('services/contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    

    #[Route('/contact/messages', name: 'app_contact_messages', methods: ['GET'])]
    public function messages(ContactRepository $contactRepository): Response
    {
        // On vérifie si l'utilisateur a le rôle ROLE_USER, sinon, refuse l'accès
        $this->denyAccessUnlessGranted('ROLE_USER');

        // On récupére de tous les contacts depuis le repository
        $messages = $contactRepository->findAll();

        // On rend la vue avec les messages des clients
        return $this->render('services/contact/messages.html.twig', [
            'messages' => $messages,
        ]);
    }

    #[Route('/contact/delete/{id}', name: 'app_contact_delete', methods: ['GET'])]
    public function delete(int $id, ContactRepository $contactRepository, EntityManagerInterface $entityManager): \Symfony\Component\HttpFoundation\RedirectResponse
    {
        $contact = $contactRepository->find($id);
    
        if (!$contact) {
            // Gérer le cas où le contact n'est pas trouvé, par exemple, rediriger avec un message d'erreur.
            return $this->redirectToRoute('app_home');
        }
    
        // Reste du code pour supprimer le contact.
        $entityManager->remove($contact);
        $entityManager->flush();
    
        // Redirection vers la page des messages après la suppression réussie
        return $this->redirectToRoute('app_contact_messages');
    }    
}
