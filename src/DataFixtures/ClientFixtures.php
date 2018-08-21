<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Client;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ClientFixtures extends Fixture
{
    public function load(ObjectManager $manager/*, UserPasswordEncoderInterface $encoder*/)
    {
        for($i = 0; $i < 10; $i++) {
            $client[$i] = new Client();

            $client[$i]
                ->setNom("Mahamat".$i)
                ->setPrenom("Mansour".$i)
                ->setDateNaissance(new\DateTime())
                ->setAdresse("9".$i." avenue du maine")
                ->setTelephone(06344)
                ->setNumeroPermis("354f55")
                ->setEmail('mail'.$i.'@gmail.com')
                ->setPassword('pass'.$i.'word'.$i)
            ;

           /* $hash = $encoder->encodePassword($client, $client->getPassword());
            $client->setPassword($hash);*/
            $manager->persist($client[$i]);
        }
        $manager->flush();
    }
}
