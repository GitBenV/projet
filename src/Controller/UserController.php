<?php

namespace App\Controller;


use App\Entity\Utilisateurs;
use App\Form\EditProfileType;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class UserController extends AbstractController
{
    /**
     * @Route("/accueil/home", name="home")
     */
    //Page d'accueil
    public function index()
    { //Elle dois se contenter d'afficher la page d'accueil qui contiendra le formulaire
        return $this->render('accueil/home.html.twig');
    }
    /* Connection */
    /**
     * @Route("user/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        //Récupères les erreurs de connexion s'il y en a
        $error = $authenticationUtils->getLastAuthenticationError();

        // Récupères l'identifiant rentré par l'utilisateur
        $lastUsername = $authenticationUtils->getLastUsername();
        //Renvoie l'utilisateur sur la page d'acceuil si la connexion est échouée.
        return $this->render('user/login.html.twig', array(
            'last_username' => $lastUsername,
            'error' => $error,
        ));
    }
    //Permet d'envoyer le formulaire d'inscription ainsi que d'encoder le mdp dans la BDD
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
        $this->denyAccessUnlessGranted("ROLE_ADMIN");
        /*-------------------------*/

        // Générons le formulaire à partir de notre UserType(RegisterType)
        $user = new Utilisateurs();
        $registerForm = $this->createForm(RegisterType::class, $user);

        // Traitement du formulaire
        $registerForm->handleRequest($request);
        if ($registerForm->isSubmitted() && $registerForm->isValid()){

            //encodage du mot de passe
            $hashed = $encoder->encodePassword($user, $user->getPassword());
            $user ->setPassword($hashed);

            //Envoie en BDD avec le MdpEncode
            $em->persist($user);
            $em->flush();
            //Redirection
            return $this->redirectToRoute('dashboard');
        }

        //En cas d'erreur on reste sur le formulaire et envoie um message
        return $this->render("user/register.html.twig", [
            "registerForm"=> $registerForm->createView()
        ]);
    }

    //
    /**
     * @Route("accueil/dashboard", name="dashboard")
     */
    public function dashboard(){
        return $this->render('accueil/dashboard.html.twig');
    }



            // Permet dafficher le utillisateur
    /**
     * @Route("/user/profil", name="profil")
     */

    public function list()
    {

        return $this->render("user/profil.html.twig", []);

    }
    /**
     * @Route("/user/profil_edit", name="profil_edit")
     */
    public function editProfils(Request $request)
    {
        $user = $this->getUser();
        $editForm = $this->createForm(EditProfileType::class, $user);

        // Traitement du formulaire une fois envoyé
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $this->addFlash('message', 'Profil mis à jour');
            return $this->redirectToRoute('dashboard');
        }
        return $this->render("user/profil_edit.html.twig", [
            "editForm"=> $editForm->createView()
        ]);
    }
    /**
     * @Route("/user/profil", name="profil")
     */
    public function editPass(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        if($request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();

            $user = $this->getUser();
            //On verifie si les 2mdp sont identique
            if ($request->request->get('pass') == $request->request->get('pass2')) {
                $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('pass')));
                /*Mise a jour dans la BDD*/
                $em->flush();
                $this->addFlash('message','Mot de passe mise a jour');
                return $this->redirectToRoute('dashboard');
            }else{
                $this->addFlash('error', 'les mots de passe doivent être identique');
            }
        }
        return $this->render("user/profil.html.twig");
    }

    /*Permet de se deco*/
    /**
     * Symfony gère entièrement cette route
     * @Route ("/logout", name="logout")
    */
    public function logout() {}

}
/*
   * @Route("/user/profil", name="profil")
   *

   public function profil(EntityManagerInterface $em)
   {
       $user = new Utilisateurs();
       $user->getId();
       $user->getUsername();
       $user->getNom();
       $user->getPrenom();
       $user->getTelephone();
       $user->getEmail();
       $user->getPassword();
       $user->getAdmin();
       $user->getCampus();
       $user->setActif(null);



       $em->flush();

       $this->addFlash('success', 'Voici votre profil.');

       return $this->render("user/profil.html.twig", []);

  }*/



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

