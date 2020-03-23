<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Formation;
use App\Entity\Entreprise;
use App\Entity\Stage;
use App\Entity\User;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        //Création de deux utilisateurs de test 
        $dorian = new User();
        $dorian->setPrenom("Dorian");
        $dorian->setNom("GIL");
        $dorian->setEmail("gildorian2000@gmail.com");
        $dorian->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
        $dorian->setPassword('$2y$10$WJQrMKnuXQPPEKZ1LEBJQOHkG.6i2reFSd.wh1HXesAd2UuNrH1ii');
        $manager->persist($dorian);

        $maeva = new User();
        $maeva->setPrenom("Maeva");
        $maeva->setNom("GIL");
        $maeva->setEmail("vava2004@gmail.com");
        $maeva->setRoles(['ROLE_USER']);
        $maeva->setPassword('$2y$10$BqYx3z6xnbWqP.nLmJUDo.xRtbbvoIJ.cgju5jcmZpYMwkVf7xR9q');
        $manager->persist($maeva);

        //Créateur d'un générateur de données Faker
        $faker = \Faker\Factory::create('fr_FR');

        //Génération des données de test Entreprise
        $EntrepriseFiducial = new Entreprise();

        $EntrepriseFiducial->setNom("Fiducial");
        $EntrepriseFiducial->setActivite($faker->realText($maxNbChars = 150, $indexSize = 2));
        $EntrepriseFiducial->setAdresse($faker->address);
        $EntrepriseFiducial->setSiteWeb($faker->url);


        $EntrepriseCreditAgricole = new Entreprise();

        $EntrepriseCreditAgricole->setNom("Crédit Agricole");
        $EntrepriseCreditAgricole->setActivite($faker->realText($maxNbChars = 150, $indexSize = 2));
        $EntrepriseCreditAgricole->setAdresse($faker->address);
        $EntrepriseCreditAgricole->setSiteWeb($faker->url);


        $EntrepriseCapGemini = new Entreprise();

        $EntrepriseCapGemini->setNom("CapGemini");
        $EntrepriseCapGemini->setActivite($faker->realText($maxNbChars = 150, $indexSize = 2));
        $EntrepriseCapGemini->setAdresse($faker->address);
        $EntrepriseCapGemini->setSiteWeb($faker->url);


        $EntrepriseWellPutt = new Entreprise();

        $EntrepriseWellPutt->setNom("Well Putt");
        $EntrepriseWellPutt->setActivite($faker->realText($maxNbChars = 150, $indexSize = 2));
        $EntrepriseWellPutt->setAdresse($faker->address);
        $EntrepriseWellPutt->setSiteWeb($faker->url);


        $EntrepriseZalando = new Entreprise();

        $EntrepriseZalando->setNom("Zalando");
        $EntrepriseZalando->setActivite($faker->realText($maxNbChars = 150, $indexSize = 2));
        $EntrepriseZalando->setAdresse($faker->address);
        $EntrepriseZalando->setSiteWeb($faker->url);


        $EntrepriseSeriousWeb = new Entreprise();

        $EntrepriseSeriousWeb->setNom("Serious Web");
        $EntrepriseSeriousWeb->setActivite($faker->realText($maxNbChars = 150, $indexSize = 2));
        $EntrepriseSeriousWeb->setAdresse($faker->address);
        $EntrepriseSeriousWeb->setSiteWeb($faker->url);


        $EntrepriseMetaPhylo = new Entreprise();

        $EntrepriseMetaPhylo->setNom("MetaPhylo");
        $EntrepriseMetaPhylo->setActivite($faker->realText($maxNbChars = 150, $indexSize = 2));
        $EntrepriseMetaPhylo->setAdresse($faker->address);
        $EntrepriseMetaPhylo->setSiteWeb($faker->url);


        //Tableau d'entreprises
        $TableauEntreprises = array($EntrepriseCapGemini, 
                                    $EntrepriseCreditAgricole, 
                                    $EntrepriseFiducial, 
                                    $EntrepriseMetaPhylo, 
                                    $EntrepriseSeriousWeb, 
                                    $EntrepriseWellPutt, 
                                    $EntrepriseZalando);

        //Mise en persistance des objets Entreprises
        foreach($TableauEntreprises as $entreprise) {
            $manager->persist($entreprise);
        }

        /* Formations 1ère version
        $formationDUTInfo = new Formation();
        $formationDUTInfo->setNomLong("Diplôme Universitaire et Technologique Informatique");
        $formationDUTInfo->setNomCourt("DUT Info");


        $formationLPMul = new Formation();
        $formationLPMul->setNomLong("Licence Professionnelle Multimédia");
        $formationLPMul->setNomCourt("LP Multimédia");


        $formationDUTIC = new Formation();
        $formationDUTIC->setNomLong("Diplôme Universitaire en Technologies de l'Information et de la Communication");
        $formationDUTIC->setNomCourt("DU TIC");

        $TableauFormation = array($formationDUTInfo, 
                                  $formationLPMul, 
                                  $formationDUTIC);

        foreach($TableauFormations as $formation) {
            $manager->persist($formation);
        }
        */

        //Génération de données de test Formation
        $TableauFormations = array(
            "DUT INFO" => "Diplôme Universitaire et Technologique Informatique",
            "LP Multimédia" => "Licence Professionnelle Multimédia",
            "DU TIC" => "Diplôme Universitaire en Technologies de l'Information et de la Communication",
            );
        

                    /********************************************************
                    *** CREATION DES STAGES ET DE LEURS FORMATIONS ASSOCIEES ***
                    *********************************************************/


        foreach ($TableauFormations as $nomCourt => $nomLong) {

            // ************* Création d'une nouvelle formation ************* //
            $FormationCourrante = new Formation();
            // Définition du nom court
            $FormationCourrante->setNomCourt($nomCourt);
            // Définition du nom long
            $FormationCourrante->setNomLong($nomLong);
            // Enregistrement de la formation créée
            $manager->persist($FormationCourrante);
            
            //Génération des données de test Stage
            $nbStageAGenerer = $faker->numberBetween($min = 0, $max = 8);
            for ($numStage = 0; $numStage < $nbStageAGenerer; $numStage++) {
                $Stage = new Stage();
                $Stage->setTitre($faker->jobTitle);
                $Stage->setDescription($faker->realText($maxNbChars = 200, $indexSize = 2));
                $Stage->setEmail($faker->companyEmail);
                
                //Création de la relation Stage --> Formation
                $Stage->addFormation($FormationCourrante);

                //Sélectionner une Entreprise au hasard parmi les 7 dans $TableauEntreprises
                $numEntreprise = $faker->numberBetween($min = 0, $max = 6);

                //Création relation Stage --> Entreprise
                $Stage->setNomEntreprise($TableauEntreprises[$numEntreprise]);

                //Création relation Entreprise --> Stage
                $TableauEntreprises[$numStage]->addStage($Stage);

                //Persistez les éléments modifiés
                $manager->persist($Stage);
                $manager->persist($TableauEntreprises[$numEntreprise]);
            }        
        }

        /*Génération de données de test Entreprise avec Faker dans une boucle itérative
        
        $nbEntreprises = 7;

        for ($i = 0 ; $i <= $nbEntreprises ; $i++) {

            $Entreprise = new Entreprise();

            $Entreprise->setNom($faker->regexify('[A-Z][a-z]{5,12}'));
            $EntrepriseFiducial->setActivite($faker->realText($maxNbChars = 150, $indexSize = 2));
            $EntrepriseFiducial->setAdresse($faker->address);
            $EntrepriseFiducial->setSiteWeb($faker->url);            
        
            $manager->persist($Entreprise);
        }*/

        //Envoyer les objets en BD
        $manager->flush();
    }
}
