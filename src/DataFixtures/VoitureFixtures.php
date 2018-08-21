<?php

namespace App\DataFixtures;

use App\Entity\Voiture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class VoitureFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 0; $i<12; $i++){


        $voiture[$i] = new Voiture();
        $voiture[$i]->setMarque("Mercedes ".$i);
        $voiture[$i]->setModele("GLK");
        $voiture[$i]->setCouleur("Noir");
        $voiture[$i]->setPlaqueImmatriculation("6".$i."56r");
        $voiture[$i]->setNumeroDeSerie("classe ".$i);
        $voiture[$i]->setKilometre(150+$i);
        if($i%2) {
            $voiture[$i]->setDisponible(true);
        }else{
            $voiture[$i]->setDisponible(false);
        }

        $manager->persist($voiture[$i]);
    }

        $manager->flush();
    }
}
