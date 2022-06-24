<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    #[Route('/panier', name: 'app_panier')]
    public function afficherPanier(): Response
    {
        $panier = [
            'savon' => ['titre' => 'savon', 'id' => 1, 'prix' => 2, 'description' => 'bien pour la proprete'],
            'brosse' => ['titre' => 'brosse a dent', 'id' => 2, 'prix' => 1, 'description' => 'utile pour les dents'],
            'serviettes' => ['titre' => 'serviette', 'id' => 3, 'prix' => 4, 'description' => 'etre plus sec '],
            'rasoir' => ['titre' => 'rasoir', 'id' => 4, 'prix' => 10, 'description' => 'coupe net']
        ];
        return $this->render('panier.html.twig', [

            'produits' => $panier,
        ]);
    }
}
