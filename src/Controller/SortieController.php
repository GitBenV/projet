<?php

namespace App\Controller;

use App\Entity\Inscriptions;
use App\Entity\Sorties;
use App\Form\SortieType;
use App\Form\SortieTypeD;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;


use Symfony\Component\Routing\Annotation\Route;


class SortieController extends AbstractController
{
    /*liste les différentes sorties*/
    /**
     * @Route("/sortie/list/", name="sortie_list")
     */

    public function list()
    {
        /* restriction des pages role user*/
        $this->denyAccessUnlessGranted("ROLE_USER");
        /*-------------------------------------*/
        $sortieRepo = $this->getDoctrine()->getRepository(Sorties::class);
        $sorties = $sortieRepo->findSorties();


        return $this->render('sortie/list.html.twig', [
            "sorties" => $sorties
        ]);
    }

    /**
    * @Route("/security/inscriptions", name="inscriptions")
    */

    public function listI()
    {

        $inscriptionRepo = $this->getDoctrine()->getRepository(Inscriptions::class);
        $inscriptions = $inscriptionRepo->findAll();


        return $this->render('security/inscriptions.html.twig', [
            "inscriptions" => $inscriptions        ]);
    }


    /**
     * @Route("/sortie/{id}", name="sortie_detail", requirements={"id": "\d+"})
     */

    public function detail($id)
    {
        //@todo : récupérer la sortie en bdd
        // donne les droit USER
        $this->denyAccessUnlessGranted("ROLE_USER");
        //recup la bdd
        $sortieRepo = $this->getDoctrine()->getRepository(Sorties::class);
        //trouve l'id
        $sortie = $sortieRepo->find($id);
        $inscriptionsRepo = $this->getDoctrine()->getRepository(Inscriptions::class);
        $inscription = $inscriptionsRepo->findAll();


            return $this->render('sortie/detail.html.twig', [
                "sortie" => $sortie, "inscription" => $inscription,
            ]);

    }



    /**
     * @Route ("/sortie/add", name="sortie_add")
     */

    public function add(EntityManagerInterface $em, Request $request)
    {
        $this->denyAccessUnlessGranted("ROLE_USER");
        $sortie = new Sorties();
        $sortieForm= $this->CreateForm(SortieType::class ,$sortie);
        $sortieFormD= $this->CreateForm(SortieTypeD::class ,$sortie);

        $sortieForm->handleRequest($request);
        $sortieFormD->handleRequest($request);
        if ($sortieForm->isSubmitted() && $sortieForm->isValid()) {
            if ($sortieFormD->isSubmitted() && $sortieFormD->isValid()) {
                $em->persist($sortie);
                $em->flush();

                $this->addFlash('success', 'La sortie a bien été créée !');
                return $this->redirectToRoute('sortie_detail', [
                    'id' => $sortie->getId()
                ]);
            }
        }
        return $this->render('sortie/add.html.twig',
            ["sortieForm" => $sortieForm->createView(), "sortieFormD" => $sortieFormD->createView()]);
    }


    /**
     * @Route("/sortie/index/{id}", name="sortie_index", requirements={"id": "\d+"})
     */
    public function inscription($id, EntityManagerInterface $em)
    {
        $this->denyAccessUnlessGranted("ROLE_USER");
        $sortieRepo = $this->getDoctrine()->getRepository(Sorties::class);
        $sortie = $sortieRepo->find($id);
        $user = $this->getUser();
        $inscription = new Inscriptions();
        $inscription -> setDateinscription(new \DateTime());
        $inscription -> setUtilisateur($user);
        $inscription -> setSortie($sortie);

        $em ->persist($inscription);
        $em ->flush();

        $this->addFlash('success', 'Vous êtes bien inscrit à la sortie.');
        return $this->render("sortie/index.html.twig", ["sortie" => $sortie, "inscription" => $inscription]);
    }

    /**
     * @Route("/sortie/annule/{id}", name="sortie_annule", requirements={"id": "\d+"})
     */
    public function annule($id, EntityManagerInterface $em)
    {
        $this->denyAccessUnlessGranted("ROLE_USER");
        $sortieRepo = $this->getDoctrine()->getRepository(Sorties::class);
        $sortie = $sortieRepo->find($id);

        $em ->remove($sortie);
        $em ->flush();

        $this->addFlash('success', 'La sortie a été annulée avec succés !');

        return $this->render("sortie/annule.html.twig", ["sortie" => $sortie]);
    }

}