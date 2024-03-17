<?php

namespace App\Controller;

use App\Repository\OffresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(OffresRepository $OffresRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'offres' => $OffresRepository->findTenByCreatedAt(),
        ]);
    }
}
