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
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use App\Form\EntrepriseType;
use App\Form\StageType;

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



    public function indexAjoutEntreprise(Request $request, ObjectManager $manager)
    {
        //Création d'une entreprise vierge qui sera remplie par le formulaire
        $entreprise = new Entreprise();

        //Création du formulaire permettant de saisir une entreprise
        $formulaireEntreprise = $this->createForm(EntrepriseType::class, $entreprise);

        /* On demande au formulaire d'analyser la dernière requête Http. Si le tableau POST contenu dans cette requête contient
        des variables nom, activite, etc. Alors la méthode handleRequest() recupère les valeurs de ces variables et les
        affecte à l'objet $entreprise. */
        $formulaireEntreprise->handleRequest($request);

        if ($formulaireEntreprise->isSubmitted() && $formulaireEntreprise->isValid())
        {
            //Enregistrer l'entreprise en base de données
            $manager->persist($entreprise);
            $manager->flush();

            //Rediriger l'utilisateur vers la page d'accueil
            return $this->redirectToRoute('pro_stage_accueil');
        }

        //Afficher la page présentant le formulaire d'ajout d'une entreprise
        return $this->render('pro_stage/ajoutModifEntreprise.html.twig', ['vueFormulaire' => $formulaireEntreprise->createView(), 
        'action'=>"ajouter"]);
    }



    public function indexModifEntreprise(Request $request, ObjectManager $manager, Entreprise $entreprise)
    {
        //Création du formulaire permettant de modifier une entreprise
        $formulaireEntreprise = $this->createForm(EntrepriseType::class, $entreprise);

        /* On demande au formulaire d'analyser la dernière requête Http. Si le tableau POST contenu dans cette requête contient
        des variables nom, activite, etc. Alors la méthode handleRequest() recupère les valeurs de ces variables et les
        affecte à l'objet $entreprise. */
        $formulaireEntreprise->handleRequest($request);

        if ($formulaireEntreprise->isSubmitted() && $formulaireEntreprise->isValid())
        {
            //Enregistrer l'entreprise en base de données
            $manager->persist($entreprise);
            $manager->flush();

            //Rediriger l'utilisateur vers la page d'accueil
            return $this->redirectToRoute('pro_stage_accueil');
        }

        //Afficher la page présentant le formulaire d'ajout d'une entreprise
        return $this->render('pro_stage/ajoutModifEntreprise.html.twig', ['vueFormulaire' => $formulaireEntreprise->createView(), 
        'action'=>"modifier"]);
    }



    public function indexFormations(FormationRepository $repositoryFormation)
    {
        //Récupérer les formations en BD
        $formations = $repositoryFormation->findAll();

        //Envoyer les formations récupérées à la vue chargée de les afficher
        return $this->render('pro_stage/formations.html.twig', ['formations'=>$formations]);
    }



    public function indexStages(StageRepository $repositoryStage, $id)
    {    
        //Récupérer le stage en BD
        $stage = $repositoryStage->getStage($id);
        
        //Envoyer le stage récupéré à la vue chargée de les afficher
        return $this->render('pro_stage/stage.html.twig', ['stage' => $stage]);
    }

    public function indexAjoutStage(Request $request, ObjectManager $manager)
    {
        //Création d'un stage vierge qui sera rempli par le formulaire
        $stage = new Stage();

        //Création du formulaire permettant de saisir un stage
        $formulaireStage = $this->createForm(StageType::class, $stage);

        /* On demande au formulaire d'analyser la dernière requête Http. Si le tableau POST contenu dans cette requête contient
        des variables nom, descriptif, etc. Alors la méthode handleRequest() recupère les valeurs de ces variables et les
        affecte à l'objet $entreprise. */
        $formulaireStage->handleRequest($request);

        if ($formulaireStage->isSubmitted() && $formulaireStage->isValid())
        {
            //Enregistrer le stage en base de données
            $manager->persist($stage);
            $manager->flush();

            //Rediriger l'utilisateur vers la page d'accueil
            return $this->redirectToRoute('pro_stage_accueil');
        }

        //Afficher la page présentant le formulaire d'ajout d'un stage
        return $this->render('pro_stage/ajoutModifStage.html.twig', ['vueFormulaire' => $formulaireStage->createView(), 
        'action'=>"ajouter"]);
    }



    public function indexModifStage(Request $request, ObjectManager $manager, Stage $stage)
    {
        //Création du formulaire permettant de modifier un stage
        $formulaireStage = $this->createForm(StageType::class, $stage);

        /* On demande au formulaire d'analyser la dernière requête Http. Si le tableau POST contenu dans cette requête contient
        des variables nom, descriptif, etc. Alors la méthode handleRequest() recupère les valeurs de ces variables et les
        affecte à l'objet $entreprise. */
        $formulaireStage->handleRequest($request);

        if ($formulaireStage->isSubmitted() && $formulaireStage->isValid())
        {
            //Enregistrer le stage en base de données
            $manager->persist($stage);
            $manager->flush();

            //Rediriger l'utilisateur vers la page d'accueil
            return $this->redirectToRoute('pro_stage_accueil');
        }

        //Afficher la page présentant le formulaire d'ajout d'un stage
        return $this->render('pro_stage/ajoutModifStage.html.twig', ['vueFormulaire' => $formulaireStage->createView(), 
        'action'=>"modifier"]);
    }




    public function indexStagesParNomEntreprise(StageRepository $repositoryStage, $nomEntreprise)
    {
        //Récupérer les stages en BD
        $stages = $repositoryStage->findByNomEntreprise($nomEntreprise);

        //Envoyer les stages récupérés à la vue qui a pour but de les afficher
        return $this->render('pro_stage/index.html.twig', ['stages'=>$stages]);
    }



    public function indexStagesParFormation(StageRepository $repositoryStage, $nomCourt)
    {
        //Récupérer les stages en BD
        $stages = $repositoryStage->findByFormation($nomCourt);

        //Envoyer les stages récupérés à la vue qui a pour but de les afficher
        return $this->render('pro_stage/index.html.twig', ['stages'=>$stages]);
    }
}
