<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Formation;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
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

        $manager->flush();
    }
}
