<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Formation;
use App\Entity\Entreprise;
class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        //Créateur d'un générateur de données Faker
        $faker = \Faker\Factory::create('fr_FR');
        
        //Génération de données de test Formation en dur
        $formationDUTInfo = new Formation();
        $formationDUTInfo->setNomLong("Diplôme Universitaire et Technologique Informatique");
        $formationDUTInfo->setNomCourt("DUT Info");
        $manager->persist($formationDUTInfo);

        $formationLPMul = new Formation();
        $formationLPMul->setNomLong("Licence Professionnelle Multimédia");
        $formationLPMul->setNomCourt("LP Multimédia");
        $manager->persist($formationLPMul);

        $formationDUTIC = new Formation();
        $formationDUTIC->setNomLong("Diplôme Universitaire en Technologies de l'Information et de la Communication");
        $formationDUTIC->setNomCourt("DU TIC");
        $manager->persist($formationDUTIC);

        //Génération de données de test Entreprise avec Faker dans une boucle itérative
        $nbEntreprises = 7;

        for ($i = 0 ; $i <= $nbEntreprises ; $i++) {

            $EntrepriseA = new Entreprise();

            $EntrepriseA->setNom($faker->regexify('[A-Z][a-z]{5,12}'));
            $EntrepriseA->setActivite($faker->realText($maxNbChars = 150, $indexSize = 2));
            $EntrepriseA->setAdresse($faker->address);
            $EntrepriseA->setSiteWeb($faker->url);

            $manager->persist($EntrepriseA);

        }

        //Envoyer les données en BD
        $manager->flush();
    }
}
