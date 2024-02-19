<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use App\Repository\HorairesRepository; 
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Cookie;

#[Route('/user')]
class UserController extends AbstractController
{
        #[Route('/', name: 'app_user_index', methods: ['GET', 'POST'])]
        public function index(UserRepository $userRepository, HorairesRepository $horairesRepository): Response
        {
            // On utilise $userRepository pour récupérer les utilisateurs
            $users = $userRepository->findAll();
    
            // On utilise $horairesRepository pour récupérer les horaires si nécessaire
            $horaires = $horairesRepository->findAll();
    
            return $this->render('services/user/index.html.twig', [
                'users' => $users,
                'horaires' => $horaires,
            ]);
        }

        #[Route('/new', name: 'app_user_registration', methods: ['GET', 'POST'])]
        public function registration(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): Response
        {
            $user = new User();
            $form = $this->createForm(UserType::class, $user);
            $form->handleRequest($request);
        
            if ($form->isSubmitted() && $form->isValid()) {
                $formData = $form->getData();
        
                // Gestion du téléchargement de l'image
                $imageFile = $formData->getImage();
                if ($imageFile) {
                    $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                    $newFilename = $originalFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();
        
                    try {
                        $imageFile->move(
                            $this->getParameter('images_directory'), // le chemin est configuré dans services.yaml
                            $newFilename
                        );
                    } catch (FileException $e) {
                        throw new \Exception('Erreur lors de l\'upload de l\'image');
                    }
        
                    // Mise à jour du champ image de l'entité User avec le nom du fichier
                    $user->setImage($newFilename);
                }
        
                // Hashage du mot de passe
                $hashedPassword = $passwordHasher->hashPassword($user, $formData->getPassword());
                $user->setPassword($hashedPassword);
        
                // Récupération des rôles depuis le formulaire
                $roles = $formData->getRoles();
        
                // Définition des rôles dans l'entité User
                $user->setRoles($roles);
        
                try {
                    $entityManager->persist($user);
                    $entityManager->flush();
                } catch (Exception $e) {
                    // Gestion de l'erreur de base de données
                    throw new \Exception('Erreur lors de la création de l\'utilisateur');
                }
        
                // Création du cookie avec la date de la dernière visite et l'option HttpOnly
                // Le cookie ne sera envoyé que sur des connexions sécurisées (HTTPS)
                $valueToStore = 'last_visit:' . date('Y-m-d H:i:s');
                $response = new Response();
                $response->headers->setCookie(
                    new Cookie('mon_cookie', $valueToStore, strtotime('+24 hours'), '/', null, false, true)
                );
                $response->send();
        
                return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
            }
        
            return $this->render('services/user/new.html.twig', [
                'user' => $user,
                'form' => $form->createView(),
            ]);
        }
        
    #[Route('/{id}', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        // L'utilisateur connecté
        $currentUser = $this->getUser();

        // Récupérez les images associées à l'utilisateur
        // $userImages = $user->getImages();
        
        
        return $this->render('services/user/show.html.twig', [
            'user' => $user,
            'currentUser' => $currentUser, 
            // On passe l'utilisateur connecté à la vue
            // 'userImages' => $userImages,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            // On récupére les données du formulaire
            $formData = $form->getData();
    
            // Si un nouveau mot de passe est fourni, le hasher et le définir
            if ($newPassword = $formData->getPassword()) {
                $hashedPassword = $passwordHasher->hashPassword($user, $newPassword);
                $user->setPassword($hashedPassword);
            }
    
            // On récupére les rôles depuis le formulaire
            $roles = $formData->getRoles();
    
            // On définit les rôles dans l'entité User
            $user->setRoles($roles);
    
            $entityManager->flush();
    
            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->render('services/user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
