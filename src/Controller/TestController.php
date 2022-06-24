<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/test', name: 'app_test')]
    public function index(): Response
    {
        $nom = 'wilson';
        $prenom = 'Sam';
        $identite = [
            'personne1' => ['nom' => 'morane', 'prenom' => 'bob'],
            'personne2' => ['nom' => 'phil', 'prenom' => 'collins']
        ];
        return $this->render("test.html.twig", [
            'prenom' => $prenom,
            'nom' => $nom,
            'identite' => $identite
        ]);
    }
}
