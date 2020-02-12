<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Stage;
use App\Entity\Entreprise;
use App\Entity\Formation;
use App\Repository\StageRepository;
use App\Repository\EntrepriseRepository;
use App\Repository\FormationRepository;

class ProStageController extends AbstractController
{
#    /**
#     * @Route("/", name="pro_stage_accueil")
#     */
    public function indexAccueil(StageRepository $repositoryStage)
    {
        //Récupérer les stages en BD
        $stages = $repositoryStage->findByTitre();

        //Envoyer les stages récupérés à la vue qui a pour but de les afficher
        return $this->render('pro_stage/index.html.twig', ['stages'=>$stages]);
    }

    public function indexEntreprises(EntrepriseRepository $repositoryEntreprise)
    {
        //Récupérer les entreprises en BD
        $entreprises = $repositoryEntreprise->findAll();
        
        //Envoyer les entreprises récupérées à la vue chargée de les afficher
        return $this->render('pro_stage/entreprises.html.twig', ['entreprises'=>$entreprises]);
    }

    public function indexFormations(FormationRepository $repositoryFormation)
    {
        //Récupérer les formations en BD
        $formations = $repositoryFormation->findAll();

        //Envoyer les formations récupérées à la vue chargée de les afficher
        return $this->render('pro_stage/formations.html.twig', ['formations'=>$formations]);
    }

    public function indexStages(Stage $stage)
    {    
        //Envoyer le stage récupéré à la vue chargée de les afficher
        return $this->render('pro_stage/stages.html.twig', ['stage' => $stage]);
    }

    public function indexStagesParNomEntreprise(StageRepository $repositoryStage, $nomEntreprise)
    {
        //Récupérer les stages en BD
        $stages = $repositoryStage->findByNomEntreprise($nomEntreprise);

        //Envoyer les stages récupérés à la vue qui a pour but de les afficher
        return $this->render('pro_stage/stagesParEntreprise.html.twig', ['stages'=>$stages]);
    }

    public function indexStagesParFormation(StageRepository $repositoryStage, $nomCourt)
    {
        //Récupérer les stages en BD
        $stages = $repositoryStage->findByFormation($nomCourt);

        //Envoyer les stages récupérés à la vue qui a pour but de les afficher
        return $this->render('pro_stage/stagesParFormation.html.twig', ['stages'=>$stages]);
    }
}
