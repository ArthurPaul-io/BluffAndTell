<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/update-pseudo', name: 'update_pseudo')]
    public function updatePseudo(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        if (!$user) {
            return new Response('Utilisateur non connecté', Response::HTTP_UNAUTHORIZED);
        }

        $pseudo = $request->cookies->get('pseudo1');

        if (!$pseudo) {
            return new Response('Aucun pseudo trouvé dans le cookie', Response::HTTP_BAD_REQUEST);
        }

        $user->setPseudo($pseudo);
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->redirectToRoute('app_games_index', [], Response::HTTP_SEE_OTHER);
    }
}
