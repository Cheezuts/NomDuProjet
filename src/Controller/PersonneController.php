<?php

namespace App\Controller;

use App\Entity\Personne;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PersonneController extends AbstractController
{
    #[Route('/personne', name: 'app_personne')]
    public function addPersonne(ManagerRegistry $doctrine): Response
    {
        // $this->getDoctrine() : Version symfony ( inf ou égal à )  5  
        $entityManager = $doctrine->getManager();
        $personne = new Personne();
        $personne->setFirstname('Jacques');
        $personne->setName('Gourgandin');
        $personne->setAge('34');

        // Ajouter l'opération d'insetion de la personne dans ma transaction
        $entityManager->persist($personne);

        // Execute la transaction
        $entityManager->flush();
        return $this->render('personne/detail.html.twig', [
            'personne' => $personne,
        ]);
    }
}
