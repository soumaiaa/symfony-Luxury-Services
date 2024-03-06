<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AboutUsController extends AbstractController
{
    #[Route('/about', name: 'app_about_us')]
    public function index(): Response
    {
        return $this->render('about/aboutUs.html.twig', [
            'controller_name' => 'AboutUsController',
        ]);
    }
}
