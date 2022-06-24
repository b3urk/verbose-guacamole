<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Auteur;
use App\Form\AuteurType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

class AuteurController extends AbstractController
{
    #[Route('/auteurs', name: 'app_auteurs')]
    public function index(ManagerRegistry $doctrine): Response
    {

        $auteurs = $doctrine->getRepository(Auteur::class)->findAll();
        return $this->render('auteur/index.html.twig', [
            'auteurs' => $auteurs,
        ]);
    }

    #[Route('/ajout-auteur', name: 'ajout_auteur')]
    public function ajout(ManagerRegistry $doctrine, Request $request): Response
    {
        $auteur = new Auteur();
        $form = $this->createForm(AuteurType::class, $auteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $manager = $doctrine->getManager();
            $manager->persist($auteur);
            $manager->flush();
            
            return $this->redirectToRoute("app_auteurs");
        }

        return $this->render("auteur/formulaire.html.twig", ["formAuteur" => $form->createView()]);
    }

    #[Route('/modif-auteur/{id<\d+>}', name: 'modif_auteur')]
    public function modif(ManagerRegistry $doctrine, Request $request, $id): Response
    {
        $auteur = $doctrine->getRepository(Auteur::class)->find($id);
        $form = $this->createForm(AuteurType::class, $auteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $manager = $doctrine->getManager();
            $manager->persist($auteur);
            $manager->flush();
            
            return $this->redirectToRoute("app_auteurs");
        }

        return $this->render("auteur/formulaire.html.twig", ["formAuteur" => $form->createView()]);
    }

    #[Route('/efface-auteur/{id}', name: 'efface_auteur')]
    public function efface(ManagerRegistry $doctrine, $id): Response
    {
        $auteur = $doctrine->getRepository(Auteur::class)->find($id);
        $manager = $doctrine->getManager();
        $manager->remove($auteur);
        $manager->flush();

        return $this->redirectToRoute("app_auteurs");
    }
}
