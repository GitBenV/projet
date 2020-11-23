<?php

namespace App\Controller;

use App\Entity\Utilisateurs;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /*Permet de rediriger et d'envoyer le formulaire d'inscription ainsi que d'encode le mdp dans la BDD*/
    /**
     * @Route("/user/register", name="register")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param UserPasswordEncoderInterface $encoder
     * @return Response
     */
    public function register(Request $request, EntityManagerInterface $em, UserPasswordEncoderInterface $encoder)
    {
        /*   restriction USER */
        $this->denyAccessUnlessGranted("ROLE_USER");
        /*-------------------------*/
        $user = new Utilisateurs();

        $registerForm = $this->createForm(RegisterType::class, $user);

        $registerForm->handleRequest($request);
        if ($registerForm->isSubmitted() && $registerForm->isValid()){
            //hasher le mot de passe
            $hashed = $encoder->encodePassword($user, $user->getPassword());
            $user ->setPassword($hashed);


            $em->persist($user);
            $em->flush();
        }

        return $this->render("user/register.html.twig", [
            "registerForm"=> $registerForm->createView()
        ]);
    }

    /* Fonction pour la connection */
    /**
     * @Route("user/login", name="login")
    */
    public function login()
    {
        return $this->render("user/login.html.twig", []);
    }

    /*
     * @Route ("/user/login", name="login")


public function add(EntityManagerInterface $em)
    {

        $utilisateur = new Utilisateurs();
        $utilisateur->setusername("titi");
        $utilisateur->setNom("tutu");
        $utilisateur->setPrenom("toto");
        $utilisateur->setTelephone(145257896);
        $utilisateur->setEmail("titi@sortie.fr");
        $utilisateur->setPassword("titi1");
        $utilisateur->setAdmin(true);
        $utilisateur->setActif(false);

        $em->persist($utilisateur);
        $em->flush();

        return $this -> render("/user/login.html.twig", []);

    }*/


            // Permet dafficher le utillisateur
    /*/**
     * @Route("/user/login", name="login")


    public function list()
    {
        $utilisateursrepo = $this->getDoctrine()->getRepository(Utilisateurs::class);
        $utilisateurs = $utilisateursrepo->findAll();
        dump($utilisateurs);

        return $this->render("user/login.html.twig");
    }*/

    /*/**
     * @Route("/user/profil", name="app_profil")

    public function profil()
    {
        return $this->render('user/profil.html.twig', []);
    }*/

    /*Permet de se deco*/
    /**
     * Symfony gère entièrement cette route
     * @Route ("/logout", name="logout")
    */
    public function logout() {}

}
