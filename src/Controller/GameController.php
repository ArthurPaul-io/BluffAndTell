<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Games;

class GameController extends AbstractController
{
    #[Route('/create-game', name: 'app_create_game', methods: ['POST', 'GET'])]
    public function createGame(EntityManagerInterface $entityManager): Response
    {
        // Générer un identifiant unique pour la partie
        $gameCode = uniqid('game_');

        // Créer une nouvelle entité Game (table correspondante dans ta base de données)
        $game = new Games();
        $game->setCode($gameCode);
        $game->setCreatedAt(new \DateTimeImmutable());
        
        // Sauvegarder dans la base de données
        $entityManager->persist($game);
        $entityManager->flush();

        // Générer un lien que les joueurs peuvent utiliser pour rejoindre
        $gameLink = $this->generateUrl('app_join_game', ['code' => $gameCode], true);

        // Retourner la réponse (HTML ou JSON selon les besoins)
        return $this->render('game/create.html.twig', [
            'gameCode' => $gameCode,
            'gameLink' => $gameLink,
        ]);
    }

    #[Route('/join-game/{code}', name: 'app_join_game', methods: ['GET'])]
    public function joinGame(string $code, EntityManagerInterface $entityManager): Response
    {
        // Rechercher la partie dans la base de données
        $gameRepository = $entityManager->getRepository(Game::class);
        $game = $gameRepository->findOneBy(['code' => $code]);

        if (!$game) {
            throw $this->createNotFoundException('Game not found!');
        }

        // Afficher la page de la partie ou ajouter le joueur à la session en cours
        return $this->render('game/join.html.twig', [
            'gameCode' => $code,
        ]);
    }
}
