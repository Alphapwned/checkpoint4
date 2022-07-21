<?php

namespace App\Controller;

use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminMessageController extends AbstractController
{
    #[Route('/admin/message', name: 'app_admin_message')]
    public function index(ContactRepository $contactRepository): Response
    {
        return $this->render('admin_message/index.html.twig', [
            'messages' => $contactRepository->findAll(),
        ]);
    }
}
