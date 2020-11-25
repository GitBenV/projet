<?php

namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class AdminController extends AbstractController

{
    //Page Dédier aux Admin
    /**
     * @Route ("/admin", name="admin_home")
     */
    public function home()
    {
        return new Response("on est la");
    }

}
