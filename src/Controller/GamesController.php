<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\AppartenirRepository;
use App\Entity\Appartenir;
use App\Entity\Games;
use App\Entity\Rounds;
use App\Entity\Ecrire;
use App\Form\GamesType;
use App\Repository\GamesRepository;
use App\Repository\ThemeRepository;
use App\Repository\RoundsRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/games')]
final class GamesController extends AbstractController
{
    #[Route(name: 'app_games_index', methods: ['GET'])]
    public function index(GamesRepository $gamesRepository): Response
    {
       
        return $this->render('games/index.html.twig', [
            'games' => $gamesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_games_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, UserRepository $userRepository, ThemeRepository $themeRepository): Response
    {
        $game = new Games();
        $game->setCreatedBy($this->getUser()); // Associe l'utilisateur connecté comme créateur
        $game->setGameStatut('en cours');

        $form = $this->createForm(GamesType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $CreatedByEmail = $form->get('CreatedBy')->getData();
            $game->setCreatedBy($CreatedByEmail);


             // Récupérer le nombre de rounds depuis le formulaire
            $numberOfRounds = $form->get('RoundCount')->getData();

            $themes = $themeRepository->findAll();
            
            $entityManager->persist($game);
            $entityManager->flush();

            // Créer les rounds
            for ($i = 1; $i <= $numberOfRounds; $i++) {
                $round = new Rounds(); // Utilisation de votre entité Rounds
                $round->setRoundsNumber($i); // Définit le numéro du round
                $round->setLapartie($game); // Associe le round à la partie

                // Choisir un thème aléatoire
                $randomTheme = $themes[array_rand($themes)];
                $round->setLetheme($randomTheme); // Associe le thème au round

                $entityManager->persist($round);
            }   

            // Sauvegarder les rounds
            $entityManager->flush();

            return $this->redirectToRoute('app_games_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('games/new.html.twig', [
            'game' => $game,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/join', name: 'app_games_join', methods: ['GET'])]
    public function join(Games $game, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser(); // Récupère l'utilisateur connecté
    
        if ($game->getGameStatut() !== 'en cours') {
            $this->addFlash('warning', 'Impossible de rejoindre cette partie.');
            return $this->redirectToRoute('app_games_index');
        }
    
        // Vérifier si l'utilisateur est déjà dans la partie
        foreach ($game->getGameusers() as $participant) {
            if ($participant->getUser() === $user) {
                $this->addFlash('info', 'Vous êtes déjà dans cette partie.');
                return $this->render('games/join.html.twig', [
                    'game' => $game, ]);
            }
        }
    
        // Crée une nouvelle relation entre l'utilisateur et la partie
        $appartenance = new Appartenir();
        $appartenance->setUser($user);
        $appartenance->setGame($game);
        $appartenance->setRole('ROLE_JOUEUR'); // Ajouter le rôle directement dans l'entité Appartenir
        $entityManager->persist($appartenance);
        $entityManager->flush();
    
        $this->addFlash('success', 'Vous avez rejoint la partie !');
        return $this->render('games/join.html.twig', [
            'game' => $game, ]);
    }
    #[Route('/{id}/show', name: 'app_games_show', methods: ['GET'])]
    public function show(Games $game): Response
    {
        return $this->render('games/show.html.twig', [
            'game' => $game,
        ]);
    }
    #[Route('/{id}/edit', name: 'app_games_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Games $game, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(GamesType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_games_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('games/edit.html.twig', [
            'game' => $game,
            'form' => $form,
        ]);
    }
    

    #[Route('/{id}', name: 'app_games_delete', methods: ['POST'])]
    public function delete(Request $request, Games $game, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$game->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($game);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_games_index', [], Response::HTTP_SEE_OTHER);
    }


    #[Route('/{id}/ready', name: 'app_games_ready', methods: ['POST'])]
    public function setReady(
    Request $request,
    EntityManagerInterface $entityManager,
    AppartenirRepository $appartenirRepository,
    GamesRepository $gameRepository,
    int $id
    
    ): JsonResponse {
    $user = $this->getUser(); // Récupère l'utilisateur connecté
    $game = $gameRepository->find($id);

    if (!$game) {
        return new JsonResponse(['error' => 'Game not found'], 404);
    }

    $appartenance = $appartenirRepository->findOneBy([
        'user' => $user,
        'game' => $game
    ]);

    if (!$appartenance) {
        return new JsonResponse(['error' => 'User not in game'], 403);
    }

    $appartenance->setReady(true);
    $entityManager->flush();

    // Vérifier si tous les joueurs sont prêts
    $allReady = $appartenirRepository->count(['game' => $game, 'ready' => false]) === 0;

    if ($allReady) {
        $game->setGameStatut('started'); // Change le statut de la partie
        $entityManager->flush();
    }

    return new JsonResponse(['message' => 'User is ready', 'allReady' => $allReady]);
    }



    #[Route('/{id}/status', name: 'app_games_status', methods: ['GET'])]
    public function getGameStatus(AppartenirRepository $appartenirRepository, int $id): JsonResponse
    {
    $players = $appartenirRepository->findBy(['game' => $id]);
    $readyPlayers = array_filter($players, fn($p) => $p->isReady());

    return new JsonResponse([
        'total' => count($players),
        'ready' => count($readyPlayers),
        'allReady' => count($players) === count($readyPlayers)
    ]);
    }

    #[Route('/{id}/play', name: 'app_games_play', methods: ['GET'])]
    public function play(GamesRepository $gamesRepository, AppartenirRepository $appartenirRepository, EntityManagerInterface $entityManager, int $id): Response
    {
    $game = $gamesRepository->find($id);

    if (!$game) {
        throw $this->createNotFoundException("La partie n'existe pas.");
    }

    // Récupérer l'utilisateur connecté
    $user = $this->getUser();

    // Récupérer l'appartenance de l'utilisateur connecté à la partie
    $appartenance = $appartenirRepository->findOneBy(['game' => $game, 'user' => $user]);


    // Récupérer tous les joueurs associés à la partie via Appartenir
    $players = $appartenirRepository->findBy(['game' => $game]);

    // Sélectionner un joueur aléatoire pour être le "Bluffeur"
    $randomPlayerKey = array_rand($players);
    $bluffeur = $players[$randomPlayerKey];

    $appartenance->setReady(false);

    // Attribuer les rôles
    foreach ($players as $player) {
        if ($player === $bluffeur) {
            $player->setRole('Bluffeur');
        } else {
            $player->setRole('Telleur');
        }
        $entityManager->persist($player);
    }

    // Sauvegarder les changements
    $entityManager->flush();




    // Récupérer tous les rounds associés à la partie, triés par numéro
    $rounds = $game->getLesrounds()->toArray();
    usort($rounds, fn($a, $b) => $a->getRoundsNumber() <=> $b->getRoundsNumber());

    // Déterminer le round actuel (le premier round non terminé)
    $currentRound = null;
    foreach ($rounds as $round) {
        if (!$round->isFinished()) {
            $currentRound = $round;
            break;
        }
    }

    // Si tous les rounds sont terminés
    if (!$currentRound) {
        $this->addFlash('info', 'Tous les rounds sont terminés.');
        return $this->redirectToRoute('app_games_index');
    }


    return $this->render('games/play.html.twig', [
        'game' => $game,
        'players' => $game->getPlayers(), // Assure-toi que getPlayers() existe
        'currentRound' => $currentRound,
        'totalRounds' => count($rounds),
        'role' => $appartenance->getRole(),
        'gameId' => $game->getId()
    ]);
    }
  



    #[Route('/{id}/play/save-anecdote', name: 'app_games_save_anecdote', methods: ['POST'])]
    public function saveAnecdote(
    Request $request,
    EntityManagerInterface $entityManager,
    AppartenirRepository $appartenirRepository,
    GamesRepository $gamesRepository,
    RoundsRepository $roundsRepository,
    int $id
): JsonResponse {
    // Récupérer les données envoyées en JSON
    $data = json_decode($request->getContent(), true);

    // Vérifier si l'anecdote est vide
    if (!isset($data['anecdote']) || empty($data['anecdote'])) {
        return new JsonResponse(['message' => 'L\'anecdote est vide'], 400);
    }

    // Récupérer l'utilisateur connecté
    $user = $this->getUser();
    if (!$user) {
        return new JsonResponse(['message' => 'Utilisateur non connecté'], 403);
    }

    // Récupérer la partie associée à l'ID
    $game = $gamesRepository->find($id);
    if (!$game) {
        return new JsonResponse(['message' => 'Partie introuvable'], 404);
    }

    // Récupérer le round actuel (le premier round non terminé)
    $round = $roundsRepository->findOneBy(['lapartie' => $game, 'finished' => false], ['id' => 'ASC']);
    if (!$round) {
        return new JsonResponse(['message' => 'Round introuvable'], 404);
    }

    // Récupérer l'appartenance de l'utilisateur à la partie
    $appartenance = $appartenirRepository->findOneBy(['game' => $game, 'user' => $user]);
    if (!$appartenance) {
        return new JsonResponse(['message' => 'Vous ne faites pas partie de cette partie.'], 403);
    }

    // Déterminer si l'utilisateur est un "Bluffeur"
    $isBluffeur = $appartenance->getRole() === 'Bluffeur';

    // Créer une nouvelle instance de Ecrire
    $anecdote = new Ecrire();
    $anecdote->setContenu($data['anecdote']);
    $anecdote->setBluffoutell($isBluffeur); // Marquer comme fausse si l'utilisateur est un Bluffeur
    $anecdote->setEcrivain($user); // Associer l'utilisateur connecté
    $anecdote->setIdRound($round); // Associer le round actuel
    $appartenance->setReady(True);

    // Sauvegarde en base de données
    $entityManager->persist($anecdote);
    $entityManager->flush();

    // return new JsonResponse(['message' => 'Anecdote enregistrée !']);
}

}


