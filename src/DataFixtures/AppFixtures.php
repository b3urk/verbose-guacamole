<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Article;
use DateTime;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        for ($i=1; $i < 10; $i++) { 
           $article = new Article();
           $article->setTitre("new title $i")
                ->setContenu("mon contenu $i")
                ->setDateDeCreation(new DateTime("now"));

            $manager->persist($article);
        }

        $manager->flush();
    }
}
