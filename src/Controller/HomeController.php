<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
// use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    // #[Route('/home', name: 'app_home')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $dernierArticle = $doctrine->getRepository(Article::class)->findOneby([],["dateDeCreation" => "DESC"]);
        return $this->render('home/index.html.twig', ["article" => $dernierArticle]);
    }
}
