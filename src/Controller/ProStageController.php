<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProStageController extends AbstractController
{
#    /**
#     * @Route("/", name="pro_stage_accueil")
#     */
    public function index()
    {
        return $this->render('pro_stage/index.html.twig', [
           'controller_name' => 'ProStageController',
        ]);
    }

    public function index2()
    {
        return $this->render('pro_stage/entreprises.html.twig', [
           'controller_name' => 'ProStageController',
        ]);
    }

    public function index3()
    {
        return $this->render('pro_stage/formations.html.twig', 
        ['controller_name' => 'ProStageController']);
    }

    public function index4($id)
    {
        return $this->render('pro_stage/stages.html.twig', 
        ['idStage' => $id]);
    }
}
