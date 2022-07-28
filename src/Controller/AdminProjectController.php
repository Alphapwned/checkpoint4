<?php

namespace App\Controller;

use App\Entity\Portfolio;
use App\Form\PortfolioType;
use App\Repository\PortfolioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/project')]
class AdminProjectController extends AbstractController
{
    #[Route('/', name: 'app_admin_project_index', methods: ['GET'])]
    public function index(PortfolioRepository $portfolioRepository): Response
    {
        return $this->render('admin_project/index.html.twig', [
            'portfolios' => $portfolioRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_project_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PortfolioRepository $portfolioRepository): Response
    {
        $portfolio = new Portfolio();
        $portfolio->setContent(' ')->setSummary(' ');
        

        $form = $this->createForm(PortfolioType::class, $portfolio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $portfolioRepository->add($portfolio, true);

            return $this->redirectToRoute('app_admin_project_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_project/new.html.twig', [
            'portfolio' => $portfolio,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_project_show', methods: ['GET'])]
    public function show(Portfolio $portfolio): Response
    {
        return $this->render('admin_project/show.html.twig', [
            'portfolio' => $portfolio,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_project_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Portfolio $portfolio, PortfolioRepository $portfolioRepository): Response
    {
        $form = $this->createForm(PortfolioType::class, $portfolio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $portfolioRepository->add($portfolio, true);

            return $this->redirectToRoute('app_admin_project_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_project/edit.html.twig', [
            'portfolio' => $portfolio,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_project_delete', methods: ['POST'])]
    public function delete(Request $request, Portfolio $portfolio, PortfolioRepository $portfolioRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$portfolio->getId(), $request->request->get('_token'))) {
            $portfolioRepository->remove($portfolio, true);
        }

        return $this->redirectToRoute('app_admin_project_index', [], Response::HTTP_SEE_OTHER);
    }
}
