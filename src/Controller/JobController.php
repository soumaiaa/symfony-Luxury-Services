<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class JobController extends AbstractController
{
    #[Route('/job', name: 'app_job')]
    public function index(): Response
    {
        return $this->render('job/job.html.twig', [
          
        ]);
    }
    #[Route('/job', name: 'app_show')]
    public function show(): Response
    {
        return $this->render('job/show.html.twig', [
            
        ]);
    }
}
