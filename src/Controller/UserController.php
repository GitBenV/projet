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
    /**
     * @Route("/user/register", name="user_register")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param UserPasswordEncoderInterface $encoder
     * @return Response
     */
    public function register(Request $request, EntityManagerInterface $em, UserPasswordEncoderInterface $encoder)
    {
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
    /**
     * @Route("/user/login", name="app_login")
    */
    public function login()
    {
        return $this->render("user/index.html.twig", []);
    }

            // Permet dafficher le utillisateur
    /**
     * @Route("/user/login", name="app_login")
    */

    public function list()
    {
        $utilisateursrepo = $this->getDoctrine()->getRepository(Utilisateurs::class);
        $utilisateurs = $utilisateursrepo->findAll();
        dump($utilisateurs);

        return $this->render("user/login.html.twig");
    }

    /**
     * @Route("/user/profil", name="app_profil")
     */
    public function profil()
    {
        return $this->render('user/profil.html.twig', []);
    }
    /**
     * Symfony gère entièrement cette route
     * @Route ("/logout", name="app_logout")
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
