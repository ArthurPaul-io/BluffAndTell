<?php

namespace App\Security;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface
{
    private EntityManagerInterface $entityManager;
    private RequestStack $requestStack;
    private RouterInterface $router;

    public function __construct(EntityManagerInterface $entityManager, RequestStack $requestStack, RouterInterface $router)
    {
        $this->entityManager = $entityManager;
        $this->requestStack = $requestStack;
        $this->router = $router;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token): Response
    {
        $user = $token->getUser();

        if ($user) {
            $pseudo = $request->cookies->get('pseudo');

            if ($pseudo) {
                $user->setPseudo($pseudo);
                $this->entityManager->persist($user);
                $this->entityManager->flush();
            }
        }

        return new RedirectResponse($this->router->generate('app_games_index')); // Redirige après connexion
    }
}
