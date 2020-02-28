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
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;

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


    public function indexAjoutEntreprise(Request $request, ObjectManager $manager)
    {
        //Création d'une entreprise vierge qui sera remplie par le formulaire
        $entreprise = new Entreprise();

        //Création du formulaire permettant de saisir une entreprise
        $formulaireEntreprise = $this->createFormBuilder($entreprise)
        ->add('nom', TextType::class)
        ->add('activite', TextareaType::class)
        ->add('adresse', TextType::class)
        ->add('siteWeb', UrlType::class)
        ->getForm();

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
        //Création du formulaire permettant de saisir une entreprise
        $formulaireEntreprise = $this->createFormBuilder($entreprise)
        ->add('nom', TextType::class)
        ->add('activite', TextareaType::class)
        ->add('adresse', TextType::class)
        ->add('siteWeb', UrlType::class)
        ->getForm();

        /* On demande au formulaire d'analyser la dernière requête Http. Si le tableau POST contenu dans cette requête contient
        des variables nom, activite, etc. Alors la méthode handleRequest() recupère les valeurs de ces variables et les
        affecte à l'objet $entreprise. */
        $formulaireEntreprise->handleRequest($request);

        if ($formulaireEntreprise->isSubmitted())
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


    public function indexStages(StageRepository $repositoryStage, $id)
    {    
        //Récupérer le stage en BD
        $stage = $repositoryStage->getStage($id);
        
        //Envoyer le stage récupéré à la vue chargée de les afficher
        return $this->render('pro_stage/stage.html.twig', ['stage' => $stage]);
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
