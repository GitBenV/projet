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

    /**
     * @Route("/", name="profil")
     */
    public function profil()
    {
        return $this->render("user/profil.html.twig", []);
    }

    /**
     * Symfony gère entièrement cette route
     * @Route ("/logout", name="logout")
     */
    public function logout() {}
}