<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Stage;
use App\Entity\Entreprise;
use App\Entity\Formation;

class ProStageController extends AbstractController
{
#    /**
#     * @Route("/", name="pro_stage_accueil")
#     */
    public function indexAccueil()
    {
        //Récupérer le repository de l'entité Stage
        $repositoryStage = $this->getDoctrine()->getRepository(Stage::class);

        //Récupérer les stages en BD
        $stages = $repositoryStage->findAll();

        //Envoyer les stages récupérés à la vue qui a pour but de les afficher
        return $this->render('pro_stage/index.html.twig', ['stages'=>$stages]);
    }

    public function indexEntreprises()
    {
        //Récupérer le repository de l'entité Entreprise
        $repositoryEntreprise = $this->getDoctrine()->getRepository(Entreprise::class);

        //Récupérer les entreprises en BD
        $entreprises = $repositoryEntreprise->findAll();
        
        return $this->render('pro_stage/entreprises.html.twig', ['entreprises'=>$entreprises]);
    }

    public function indexFormations()
    {
        //Récupérer le repository de l'entité Formation
        $repositoryFormation = $this->getDoctrine()->getRepository(Formation::class);

        //Récupérer les formations en BD
        $formations = $repositoryFormation->findAll();

        return $this->render('pro_stage/formations.html.twig', ['formations'=>$formations]);
    }

    public function indexStages($id){
        
        //Récupérer le repository de l'entité Stage
        $repositoryStage = $this->getDoctrine()->getRepository(Stage::class);

        //Récupérer les stage en BD
        $stage = $repositoryStage->find($id);

        return $this->render('pro_stage/stages.html.twig', 
        ['stage' => $stage]);
    }
}
