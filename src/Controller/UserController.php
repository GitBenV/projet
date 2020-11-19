<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{

    /**
     * @Route("/login", name="login")
     */
    public function login()
    {
        return $this->render("user/login.html.twig", []);
    }
    /*          Permet dafficher le utillisateur
    /**
     * @Route("/login", name="login")

    public function list()
    {
        $utilisateursrepo = $this->getDoctrine()->getRepository(Utilisateurs::class);
        $utilisateurs = $utilisateursrepo->findAll();
        dump($utilisateurs);

        return $this->render("user/login.html.twig");
    }
    */

    /**
     * @Route("/", name="profil")
     */
    public function profil()
    {
        return $this->render('user/profil.html.twig', []);
    }

    /**
     * Symfony gère entièrement cette route
     * @Route ("/logout", name="logout")
     */
    public function logout() {}

    /*/**
     * @Route("/login", name="login")


        public function add(EntityManagerInterface $em)
    {

        $utilisateur= new Utilisateurs();
        $utilisateur->setPseudo("Testo");
        $utilisateur->setNom("Testa");
        $utilisateur->setPrenom("Le Testeur");
        $utilisateur->setTelephone(0616455645);
        $utilisateur->setMail("test@gmail.com");
        $utilisateur->setPassword("1234");
        $utilisateur->setAdmin(true);
        $utilisateur->setActif(true);
        $utilisateur->setCampus(1);

        //$em->persist($utilisateur);
        //$em->flush();



        return $this->render('user/login.html.twig');

    }*/




}
