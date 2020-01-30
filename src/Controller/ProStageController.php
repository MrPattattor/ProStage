<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Stage;

class ProStageController extends AbstractController
{
#    /**
#     * @Route("/", name="pro_stage_accueil")
#     */
    public function indexAccueil()
    {
        //Récupérer le repository de l'entité Stage
        $repositoryStage = $this->getDoctrine()->getRepository(Stage::class);

        //Récupérer les stage en BD
        $stages = $repositoryStage->findAll();

        //Envoyer les stages récupérés à la vue qui a pour but de les afficher
        return $this->render('pro_stage/index.html.twig', ['stages'=>$stages]);
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
