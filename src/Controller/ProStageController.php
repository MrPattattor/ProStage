<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProStageController extends AbstractController
{
    /**
     * @Route("/", name="pro_stage_accueil")
     */
    public function index()
    {
        return $this->render('pro_stage/index.html.twig', [
            'controller_name' => 'ProStageController',
        ]);
    }
}
