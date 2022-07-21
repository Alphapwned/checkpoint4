<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\Contact1Type;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/message')]
class AdminMessageController extends AbstractController
{
    #[Route('/', name: 'app_admin_message_index', methods: ['GET'])]
    public function index(ContactRepository $contactRepository): Response
    {
        return $this->render('admin_message/index.html.twig', [
            'contacts' => $contactRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_message_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ContactRepository $contactRepository): Response
    {
        $contact = new Contact();
        $form = $this->createForm(Contact1Type::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contactRepository->add($contact, true);

            return $this->redirectToRoute('app_admin_message_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_message/new.html.twig', [
            'contact' => $contact,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_message_show', methods: ['GET'])]
    public function show(Contact $contact): Response
    {
        return $this->render('admin_message/show.html.twig', [
            'contact' => $contact,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_message_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Contact $contact, ContactRepository $contactRepository): Response
    {
        $form = $this->createForm(Contact1Type::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contactRepository->add($contact, true);

            return $this->redirectToRoute('app_admin_message_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_message/edit.html.twig', [
            'contact' => $contact,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_message_delete', methods: ['POST'])]
    public function delete(Request $request, Contact $contact, ContactRepository $contactRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contact->getId(), $request->request->get('_token'))) {
            $contactRepository->remove($contact, true);
        }

        return $this->redirectToRoute('app_admin_message_index', [], Response::HTTP_SEE_OTHER);
    }
}
