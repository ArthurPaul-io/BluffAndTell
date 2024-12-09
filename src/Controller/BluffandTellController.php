<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BluffandTellController extends AbstractController
{
    #[Route('/', name: 'app_bluffandtell')]
    public function index(): Response
    {
        return $this->render('bluffand_tell/home.html.twig', [
            'controller_name' => 'BluffandTellController',
        ]);
    }
}