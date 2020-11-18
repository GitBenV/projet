<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SortieController extends AbstractController
{
    /**
     * @Route("/sortie", name="sortie_list")
     */
    public function list()
    {
        //@todo : récupérer les sorties en bdd

        return $this->render('sortie/list.html.twig', []);
    }

    /**
     * @Route("/sortie/{id}", name="sortie_detail", requirements={"id": "\d+"})
     */
    public function detail($id)
    {
        //@todo : récupérer la sortie en bdd

        return $this->render('sortie/detail.html.twig', []);
    }

    /**
     * @Route ("/sortie/add", name="serie_add")
     */
    public function add()
    {
        //@todo: traiter le formulaire

        return $this->render('sortie/add.html.twig');
    }

}
