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
    * @Route("/test", name="test")
    */
    public function test(){
        return new RedirectResponse('https://pitlorquy.000webhostapp.com/general/');
    }
}
