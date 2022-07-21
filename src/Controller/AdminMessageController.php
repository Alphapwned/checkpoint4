<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\Contact1Type;
use App\Repository\ContactRepository;
use Doctrine\Persistence\ManagerRegistry;
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

    #[Route('/{id}', name: 'app_admin_message_show', methods: ['GET'])]
    public function show(Contact $contact): Response
    {
        return $this->render('admin_message/show.html.twig', [
            'contact' => $contact,
        ]);
    }

    #[Route('/delete/{id}', methods: ['GET', 'DELETE'], name: 'app_admin_message_delete')]
    public function delete(ManagerRegistry $doctrine, int $id): Response
    {
        $messageManager = $doctrine->getManager();
        $messageUserContact = $messageManager->getRepository(Contact::class)->find($id);

        if (!$messageUserContact) {
            throw $this->createNotFoundException(
                'No message found for this contact.'
            );
        }

        $messageUserContact->setIsHidden('0');
        $messageManager->flush();

        return $this->redirectToRoute('app_admin_message_index', [
            'id' => $messageUserContact->getId()
        ]);
    }
}
