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
        //**********************    TEST   *******************//
        /*$this->getDoctrine()->getRepository(Utilisateurs::class);
        if ($this->==true) {
        return $this->redirectToRoute('user/index.html.twig', []);
        }*/

        //Ouverture et point d'entrer du site.
        return $this->render("accueil/home.html.twig", []);
    }


}


