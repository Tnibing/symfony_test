<?php

namespace App\Controller;

use App\Entity\Account;
use App\Form\AccountType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AccountController extends AbstractController
{
    #[Route('/account/list', name: 'account_list')]
    public function list(EntityManagerInterface $entityManager): Response
    {
        $accountRepository = $entityManager->getRepository(Account::class);

        $accounts = $accountRepository->findAll();

        return $this->render('account/list.html.twig', [
            'accounts' => $accounts,
        ]);
    }

    #[Route('/account/new', name: 'account_new')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $account = new Account();

        $form = $this->createForm(AccountType::class, $account, array('submit' => 'Crear cuenta'));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $account = $form->getData();

            $entityManager->persist($account);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Nou compte ' . $account->getCodigo() . ' creat!'
            );
            return $this->redirectToRoute('account_list');
        }

        return $this->render('account/account.html.twig', [
            'form' => $form->createView(),
            'title' => 'Cuenta nueva',
        ]);
    }

    #[Route('/account/delete/{id}', name: 'account_delete', requirements: ['id' => '\d+'])]
    public function delete($id, EntityManagerInterface $entityManager)
    {
        $account = $entityManager
            ->getRepository(Account::class)
            ->find($id);

        if (!$account) {
            throw $this->createNotFoundException(
                'No se encontró el compte con id ' . $id
            );
        }

        $entityManager->remove($account);
        $entityManager->flush();

        $this->addFlash(
            'notice',
            'Cuenta ' . $account->getCodigo() . ' eliminada!'
        );

        return $this->redirectToRoute('account_list');
    }

    #[Route('/account/edit/{id}', name: 'account_edit', requirements: ['id' => '\d+'])]
    public function edit($id, EntityManagerInterface $entityManager, Request $request)
    {
        $editedAccount = $entityManager
            ->getRepository(Account::class)
            ->find($id);

        if (!$editedAccount) {
            throw $this->createNotFoundException(
                'No se encontró el compte con id ' . $id
            );
        }

        //$editedAccount = new Account();

        $form = $this->createForm(AccountType::class, $editedAccount, array('submit' => 'Editar cuenta'));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $editedAccount = $form->getData();
            $entityManager->persist($editedAccount);
            $entityManager->flush();


            $this->addFlash(
                'notice',
                'Cuenta ' . $editedAccount->getCodigo() . ' editada!'
            );
            return $this->redirectToRoute('account_list');
        }

        // TODO


        return $this->render('account/account.html.twig', [
            'form' => $form->createView(),
            'title' => 'Cuenta nueva',
        ]);
    }
}
