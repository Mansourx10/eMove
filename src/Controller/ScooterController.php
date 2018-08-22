<?php

namespace App\Controller;

use App\Repository\VoitureRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ScooterController extends Controller
{
    /**
     * @Route("/scooter", name="scooter")
     */
    public function index()
    {
        return $this->render('scooter/index.html.twig', [
            'controller_name' => 'ScooterController',
        ]);
    }

    /**
     * @Route("list", name="list_scooter")
     */
    public function ListScooter(VoitureRepository $voitureRepository)
    {
        return $this->render('scooter/index.html.twig', ['scooters' =>$voitureRepository->findByScooter(true)]);
    }
}
