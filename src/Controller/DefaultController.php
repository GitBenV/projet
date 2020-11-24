<?php

namespace App\Controller;


use App\Entity\Utilisateurs;
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
        /*$this->getDoctrine()->getRepository(Utilisateurs::class);
        if ($this->==true) {
        return $this->redirectToRoute('user/index.html.twig', []);
        }*/
        return $this->render("accueil/home.html.twig", []);
    }


}


