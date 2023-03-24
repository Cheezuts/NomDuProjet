<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {
        // Chercher au niveau de la base de donnée vos Users pour pouvoir les affichers dans templates/home/index.html.twig
        return $this->render('home/index.html.twig', [
            'name' => 'Gourgandin',
            'firstname' => 'Jacques'
        ]);
    }

    #[Route('/template', name: 'template')]
    public function template(): Response
    {
        // Chercher au niveau de la base de donnée vos Users pour pouvoir les affichers dans templates/home/index.html.twig
        return $this->render('template.html.twig');
    }
}