<?php

namespace App\Controller;



use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /*Ouvre la page d'accueil*/
    /**
     * @Route("/", name="home")
     */

    public function home()
    {
        return $this->render("accueil/home.html.twig");
    }

}


