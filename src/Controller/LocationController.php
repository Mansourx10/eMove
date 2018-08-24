<?php

namespace App\Controller;

use App\Entity\Location;
use App\Form\LocationType;
use App\Repository\LocationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @Route("/location")
 */
class LocationController extends Controller
{
    /**
     * @Route("/", name="location_index", methods="GET")
     */
    public function index(LocationRepository $locationRepository): Response
    {
        return $this->render('location/index.html.twig', ['locations' => $locationRepository->findAll()]);
    }

    /**
     * @Route("/new", name="location_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $user = $this->getUser();
        $location = new Location();

        $form = $this->createForm(LocationType::class, $location);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $location->setClient($user);
            $location->setDateAchat(new \DateTime());
            $debut = $location->getDebutLocation();
            $fin = $location->getFinLocation();

            if ($debut < $fin)
            {
                $interval = $debut->diff($fin);

                $location->setPrix($interval->days * 129);
                $location->setStatus("En location");
                $em = $this->getDoctrine()->getManager();
                $em->persist($location);
                $em->flush();

                return $this->redirectToRoute('location_index');
            }else{
                throw new NotFoundHttpException("La date du début de location ne peut pas être inferieur ou égale a la date du fin de location ");
                }
        }

        return $this->render('location/new.html.twig', [
            'locations' => $location,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="location_show", methods="GET")
     */
    public function show(Location $location): Response
    {
        return $this->render('location/show.html.twig', ['location' => $location]);
    }

    /**
     * @Route("/{id}/edit", name="location_edit", methods="GET|POST")
     */
    public function edit(Request $request, Location $location): Response
    {
        $form = $this->createForm(LocationType::class, $location);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('location_edit', ['id' => $location->getId()]);
        }

        return $this->render('location/edit.html.twig', [
            'location' => $location,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="location_delete", methods="DELETE")
     */
    public function delete(Request $request, Location $location): Response
    {
        if ($this->isCsrfTokenValid('delete'.$location->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($location);
            $em->flush();
        }

        return $this->redirectToRoute('location_index');
    }

    /**
     * @Route("/client/list", name="location_client", methods={"GET"})
     */
    public function location_client(Request $request, LocationRepository $locationRepository)
    {
        $user = $this->getUser();

        return $this->render('location/location_client.html.twig', ['locations' => $locationRepository->findBy(['Client' => $user->getId()])]);
    }
}
