<?php

namespace App\Controller;

use App\Entity\Candidats;
use App\Entity\Candidatures;
use App\Entity\Offres;
use App\Repository\CandidatsRepository;
use App\Repository\CandidaturesRepository;
use App\Repository\CategorieRepository;
use App\Repository\OffresRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class JobController extends AbstractController
{
    #[Route('/job', name: 'app_job')]
    public function index(OffresRepository $OffresRepository, CategorieRepository $CategorieRepository): Response
    {
        $offres = $OffresRepository->findAll();
        $categories = $CategorieRepository->findAll();
        return $this->render('job/job.html.twig', [
            'offres' => $offres,
            'categories' => $categories // Utilisez le nom correct de la variable
        ]);
    }
    #[Route('/{id}/show', name: 'app_show')]
    public function show(Offres $offre,CandidatsRepository $candidatsRepository, CandidaturesRepository $candidaturesRepository ,OffresRepository $OffresRepository): Response
    {
        $offres = $OffresRepository->findAll();
        $candidat = $candidatsRepository->findOneBy(['user' => $this->getUser()]);
        $candidatures = $candidaturesRepository->findOneBy(['candidat' => $candidat, 'offre'=> $offre ]);
       
        $previousOffre = $OffresRepository->findPreviousOffre($offre);
        $nextOffre = $OffresRepository->findNextOffre($offre);
        $user = $this->getUser();
        if ($user) {

                return $this->render('job/show.html.twig', [
                'offre' => $offre,
                'offres' => $offres,
                'previousOffre' => $previousOffre,
                'nextOffre' => $nextOffre,
                'candidatures'=> $candidatures
            ]);

        } else {
            return $this->redirectToRoute('app_login');
        }     
    }
    #[Route('/{id}/apply', name: 'app_Apply')]
    public function apply(Offres $offre, CandidaturesRepository $candidaturesRepository, CandidatsRepository $candidatsRepository, EntityManagerInterface $entityManager): Response
    {


        $user = $this->getUser();
        if (!$user) {
            $this->addFlash('failed', 'You must be logged to submit an application');
            return $this->redirectToRoute('app_register');
        }
        // dd($user);
        $candidat = $candidatsRepository->findOneBy(['user' => $this->getUser()]);
        //    dd($candidat);      
        // if (!$candidat) {
        //     $this->addFlash('failed', 'You must be logged to submit an application');
        //     return $this->redirectToRoute('app_candidats_profile',  ['user' => $this->getUser()]);
        // }
        
        $candidatures = $candidaturesRepository->findOneBy(['candidat' => $candidat, 'offre'=> $offre ]);
        //    dd($candidatures);
       if(!$candidatures){
         $candidature = new Candidatures();
        // Set the job offer for the candidature
        $candidature->setOffre($offre);
        // Set the candidat for the candidature
        $candidature->setCandidat($candidat);
        // Set the application date
        $candidature->setDate(new DateTimeImmutable());
        $entityManager->persist($candidature);
        $entityManager->flush();
         // Add a flash message to indicate successful application
        $this->addFlash('success', 'Your application has been submitted successfully.');
        return $this->redirectToRoute('app_home');
        }else if ($candidatures){
        $this->addFlash('success', 'You have applied for this job.');
        return $this->redirectToRoute('app_home');
        }
  

    }

}
