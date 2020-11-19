<?php

namespace App\Controller;

use App\Entity\Sorties;
use Doctrine\ORM\EntityManagerInterface;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SortieController extends AbstractController
{
    /**
     * @Route("/sortie/list", name="sortie_list")
     */
    public function list()
    {
        $sortieRepo = $this->getDoctrine()->getRepository(Sorties::class);
        $sorties = $sortieRepo->findSorties();

        return $this->render('sortie/list.html.twig', [
            "sorties" => $sorties
        ]);
    }

    /**
     * @Route("/sortie/{id}", name="sortie_detail", requirements={"id": "\d+"})
     */
    public function detail($id)
    {
        //@todo : récupérer la sortie en bdd

        $sortieRepo = $this->getDoctrine()->getRepository(Sorties::class);
        $sortie = $sortieRepo->find($id);

        return $this->render('sortie/detail.html.twig', [
            "sortie" => $sortie
        ]);
    }
    /*
    /**
     * @Route ("/sortie/add", name="sortie_add")

    public function add(EntityManagerInterface $em)
    {



        $sortie = new Sorties();
        $sortie->setNom("sortie3");
        $sortie->setDatedebut(new \DateTime("2020-07-07 12:00:00"));
        $sortie->setDatecloture(new \DateTime("2020-08-08 12:00:00"));
        $sortie->setDuree(new \DateTime());
        $sortie->setNbinscriptionsmax(20);
        $sortie->setDescriptioninfos("sortie3");
        $sortie->setOrganisateur(1);

        $em->persist($sortie);
        $em->flush();

        //$em->remove($sortie);
        //$em->flush();

        return $this->render('sortie/add.html.twig');
    }
    */
}
