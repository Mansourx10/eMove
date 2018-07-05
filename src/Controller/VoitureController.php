<?php

namespace App\Controller;

use App\Entity\Voiture;
use App\Form\VoitureType;
use App\Repository\VoitureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/voiture")
 */
class VoitureController extends Controller
{
    /**
     * @Route("/", name="voiture_index", methods="GET")
     */
    public function index(VoitureRepository $voitureRepository): Response
    {
        return $this->render('voiture/index.html.twig', ['voitures' => $voitureRepository->findAll()]);
    }

    /**
     * @Route("/new", name="voiture_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $voiture = new Voiture();
        $form = $this->createForm(VoitureType::class, $voiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($voiture);
            $em->flush();

            return $this->redirectToRoute('voiture_index');
        }

        return $this->render('voiture/new.html.twig', [
            'voiture' => $voiture,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="voiture_show", methods="GET")
     */
    public function show(Voiture $voiture): Response
    {
        return $this->render('voiture/show.html.twig', ['voiture' => $voiture]);
    }

    /**
     * @Route("/{id}/edit", name="voiture_edit", methods="GET|POST")
     */
    public function edit(Request $request, Voiture $voiture): Response
    {
        $form = $this->createForm(VoitureType::class, $voiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('voiture_edit', ['id' => $voiture->getId()]);
        }

        return $this->render('voiture/edit.html.twig', [
            'voiture' => $voiture,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="voiture_delete", methods="DELETE")
     */
    public function delete(Request $request, Voiture $voiture): Response
    {
        if ($this->isCsrfTokenValid('delete'.$voiture->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($voiture);
            $em->flush();
        }

        return $this->redirectToRoute('voiture_index');
    }
}
