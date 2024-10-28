<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class ClientController extends AbstractController
{
    #[Route('/client/list', name: 'client_list')]
    public function list(EntityManagerInterface $entityManager): Response
    {
        $clientsRepository = $entityManager->getRepository(Client::class);

        $clients = $clientsRepository->findAll();

        return $this->render('client/list.html.twig', [
            'clientes' => $clients,
        ]);
    }

    #[Route('/client/new', name: 'client_new')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $client = new Client();

        $form = $this->createForm(ClientType::class, $client, array('submit' => 'Crear cliente'));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $client = $form->getData();

            $entityManager->persist($client);
            $entityManager->flush();
        }

        return $this->render('client/client.html.twig', [
            'form' => $form->createView(),
            'title' => 'Cliente nuevo',
        ]);
    }

    #[Route('/client/delete/{id}', name: 'client_delete', requirements: ['id' => '\d+'])]
    public function delete($id, EntityManagerInterface $entityManager)
    {
        $client = $entityManager
            ->getRepository(Client::class)
            ->find($id);

        if (!$client) {
            throw $this->createNotFoundException(
                'No se encontró el cliente con id ' . $id
            );
        }

        $entityManager->remove($client);
        $entityManager->flush();

        $this->addFlash(
            'notice',
            'Cliente ' . $client->getCodi() . ' eliminado!'
        );

        return $this->redirectToRoute('client_list');
    }
}
