<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProStageController extends AbstractController
{
#    /**
#     * @Route("/", name="pro_stage_accueil")
#     */
    public function indexAccueil()
    {
        return $this->render('pro_stage/index.html.twig');
    }

    public function indexEntreprises()
    {
        return $this->render('pro_stage/entreprises.html.twig');
    }

    public function indexFormations()
    {
        return $this->render('pro_stage/formations.html.twig');
    }

    public function indexStages($id)
    {
        return $this->render('pro_stage/stages.html.twig', 
        ['idStage' => $id]);
    }
}
