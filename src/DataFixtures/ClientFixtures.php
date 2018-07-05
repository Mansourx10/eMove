<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Client;

class ClientFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 0; $i < 10; $i++) {
            $client[$i] = new Client();
            $client[$i]
                ->setNom("Mahamat".$i)
                ->setPrenom("Mansour".$i)
                ->setDateNaissance(new\DateTime())
                ->setAdresse("9".$i." avenue du maine")
                ->setTelephone(06344)
                ->setNumeroPermis("354f55");

            $manager->persist($client[$i]);
        }
        $manager->flush();
    }
}
