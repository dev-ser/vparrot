<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        // On redirige si l'utilisateur est déjà connecté
        if ($this->getUser() !== null) {
            // On vérifie le rôle de l'utilisateur et rediriger en conséquence
            if ($this->isGranted('ROLE_ADMIN')) {
                return $this->redirectToRoute('app_admin');
            } else {
                return $this->redirectToRoute('app_employes');
            }
        }

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout', methods: ['GET', 'POST'])]
    public function logout(): RedirectResponse
    {
        return new RedirectResponse($this->generateUrl('app_home'));
    }

    #[Route(path: "/CGU", name: "app_CGU")]
    public function legalNotices(UserRepository $repository): Response
    {
        $users = $repository->findAll();
        $user = $this->getUser();

        return $this->render("security/mentionsCGU.html.twig", [
            "users" => $users,
            "user" => $user
        ]);
    }
}
