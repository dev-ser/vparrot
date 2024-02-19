<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;
use Twig\Environment;

class AccessDeniedHandler implements AccessDeniedHandlerInterface
{
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function handle(Request $request, AccessDeniedException $accessDeniedException): Response
    {
        // On personnalise votre réponse pour l'accès refusé ici
        $errorMessage = 'Vous n\'êtes pas autorisé à accéder à cette page.';

        $content = $this->twig->render('access_denied/index.html.twig', [
            'error_message' => $errorMessage,
        ]);

        return new Response($content, Response::HTTP_FORBIDDEN); // Réponse 403 Forbidden
    }
}
