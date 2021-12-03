<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;

class PageController extends AbstractController
{

    private $articles;
    
        /**
        * @Route("/", name="home")
        */
        public function home(){
        return $this->render("index.html.twig");
        } 



        /**
        * @Route("/book/{id}", name="book")
        */
        public function __construct()
        {

            //je cree un article (book) contenant des information (nom de livre ect)
            $this->books = [
                1 => [
                    "title" => "Dune",
                    "author" => "Franck Herbert",
                    "publishedAt" => new \DateTime('NOW'),
                    "image" => "https://images-na.ssl-images-amazon.com/images/I/41rDK8Jb1LL._SX312_BO1,204,203,200_.jpg",
                    "id" => 1
                ],
                2 => [
                    "title" => "Silo",
                    "author" => "Tery Hayes",
                    "publishedAt" => new \DateTime('NOW'),
                    "image" => "https://professionvoyages.com/wp-content/uploads/2016/07/roman-fantastique-lecture-ete-vacances.jpg",
                    "id" => 2
                ],
                3 => [
                    "title" => "Win",
                    "author" => "Harlan Coben",
                    "publishedAt" => new \DateTime('NOW'),
                    "image" => "https://images-na.ssl-images-amazon.com/images/I/81MH9QEw+5L.jpg",
                    "id" => 3
                ],
                4 => [
                    "title" => "La part de l'autre",
                    "author" => "Éric-Emmanuel Schmitt",
                    "publishedAt" => new \DateTime('NOW'),
                    "image" => "https://static.fnac-static.com/multimedia/FR/Images_Produits/FR/fnac.com/Visual_Principal_340/9/7/3/9782253155379/tsp20121001175117/La-part-de-l-autre.jpg",
                    "id" => 4
                ],
                5 => [
                    "title" => "Snowman",
                    "author" => "Jo Nesbo",
                    "publishedAt" => new \DateTime('NOW'),
                    "image" => "https://images-na.ssl-images-amazon.com/images/I/817jnkcA+jL.jpg",
                    "id" => 5
                ]
            ];
        }

            /**
            * @Route("/article/{id}", name="article_show")
            */
            public function articleShow($id)
            {
            // je cree une erreur qui affiche "cette page existe pas." si l'on utilise un id qui nexiste pas
            if (!array_key_exists($id, $this->books)) {
                throw $this->createNotFoundException('cette page existe pas.');
            }
        
            return $this->render("indexBookVew.html.twig", ["book" => $this->books[$id]]);
        }

        /**
        * @Route("/books", name="books")
        */
        public function books() //j'integre mon id
        {
            return $this->render("indexBooks.html.twig", ["books" => $this->books]);
    }
}