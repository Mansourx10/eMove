<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientAdminType;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ClientController extends Controller
{
    /**
     * @Route("admin/client/", name="client_index", methods="GET")
     */
    public function index(ClientRepository $clientRepository): Response
    {
        return $this->render('client/index.html.twig', ['clients' => $clientRepository->findAll()]);
    }

    /**
     * @Route("client/inscription", name="inscription", methods="GET|POST")
     */
    public function new(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $client = new Client();
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->encodePassword($client, $client->getPassword());
            $client->setPassword($hash);

            $em = $this->getDoctrine()->getManager();
            $em->persist($client);
            $em->flush();

            return $this->redirectToRoute('security_login');
        }

        return $this->render('security/inscription.html.twig', [
            'client' => $client,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("client/{id}", name="client_show", methods="GET")
     */
    public function show(Client $client): Response
    {
        return $this->render('client/show.html.twig', ['client' => $client]);
    }

    /**
     * @Route("client/{id}/edit", name="client_edit", methods="GET|POST")
     */
    public function edit(Request $request, Client $client): Response
    {
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('client_edit', ['id' => $client->getId()]);
        }

        return $this->render('client/edit.html.twig', [
            'client' => $client,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("admin/client/{id}", name="client_delete", methods="DELETE")
     */
    public function delete(Request $request, Client $client): Response
    {
        if ($this->isCsrfTokenValid('delete'.$client->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($client);
            $em->flush();
        }

        return $this->redirectToRoute('client_index');
    }

    /**
     * @Route("admin/client/{id}/editAdmin", name="client_editAdmin", methods="GET|POST")
     */
    public function editAdmin(Request $request, Client $client): Response
    {
        $form = $this->createForm(ClientAdminType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('client_editAdmin', ['id' => $client->getId()]);
        }

        return $this->render('client/editAdmin.html.twig', [
            'client' => $client,
            'form' => $form->createView(),
        ]);
    }

}
