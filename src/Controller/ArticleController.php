<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/articles', name: 'app_article')]
    public function allArticles(ManagerRegistry $doctrine): Response
    {
        $articles = $doctrine->getRepository(Article::class)->findAll();
        return $this->render('article/allArticles.html.twig', [
            'articles' => $articles,
        ]);
    }


    #[Route('/ajout-article', name: 'ajout_article')]
    public function ajout(ManagerRegistry $doctrine, Request $request)
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $article->setDateDeCreation(new DateTime('now'));
            $manager = $doctrine->getManager();
            $manager->persist($article);
            $manager->flush();

            return $this->redirectToRoute("app_article");
        }

        return $this->render("article/formulaire.html.twig", ["formArticle" => $form->createView()]);
    }

    #[Route('/modif-article/{id}', name: 'modif_article')]
    public function modif(ManagerRegistry $doctrine, Request $request, $id)
    {
        $article = $doctrine->getRepository(Article::class)->find($id);
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $article->setDateDeModification(new DateTime('now'));
            $manager = $doctrine->getManager();
            $manager->persist($article);
            $manager->flush();

            return $this->redirectToRoute("app_article");
        }

        return $this->render("article/formulaire.html.twig", ["formArticle" => $form->createView()]);
    }
    #[Route('/efface-article/{id}', name: 'efface_article')]
    public function efface(ManagerRegistry $doctrine, $id)
    {
        $article = $doctrine->getRepository(Article::class)->find($id);
        $manager = $doctrine->getManager();
        $manager->remove($article);
        $manager->flush();
        return $this->redirectToRoute("app_article");
    }

    #[Route('/lire-article/{id}', name: 'lire_article')]
    public function lire(ManagerRegistry $doctrine, $id)
    {
        $article = $doctrine->getRepository(Article::class)->find($id);
        return $this->render("article/lire.html.twig", ["article" => $article]);
    }
}
