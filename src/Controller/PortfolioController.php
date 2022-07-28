<?php

namespace App\Controller;

use App\Repository\PortfolioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PortfolioController extends AbstractController
{
    #[Route('/portfolio', name: 'app_portfolio')]
    public function index(PortfolioRepository $portfolioRepository): Response
    {
        return $this->render('portfolio/index.html.twig', [
            'projects' => $portfolioRepository->findAll()
        ]);
    }

    #[Route('/portfolio/{id<^[0-9]+$>}', name: 'app_portfolio_show')]
    public function show(int $id, PortfolioRepository $portfolioRepository): Response
    {
        $portfolio = $portfolioRepository->findOneBy(['id' => $id]);
        if (!$portfolio) {
            throw $this->createNotFoundException(
                'The project that you are looking for is not found'
            );
        }
        return $this->render('portfolio/show.html.twig', [
            'portfolio' => $portfolio,
        ]);
    }
}
