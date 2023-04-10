<?php

namespace App\Controller;

use App\Entity\Personne;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/personne', name: 'personne')]
class PersonneController extends AbstractController
{
    #[Route('/', name: 'personne.list')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Personne::class);
        $personnes = $repository->findAll();
        return $this->render(view: 'personne/index.html.twig', parameters: ['personnes' => $personnes]);
    }


    #[Route('/personne/{id<\d+>}', name: 'personne.detail.html')]
    public function detail(ManagerRegistry $doctrine, $id): Response
    {
        $repository = $doctrine->getRepository(Personne::class);
        $personne = $repository->find($id);
        $errorMessage = null;
        if(!$personne){
            $errorMessage = "La personne d'id $id n'existe pas";
        }
        return $this->render('personne/detail.html.twig', [
            'personne' => $personne,
            'errorMessage' => $errorMessage,
        ]);
    }

    #[Route('/add', name: 'personne.add')]
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
