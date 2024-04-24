<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use App\Repository\OffresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(OffresRepository $offresRepository, CategorieRepository $categorieRepository): Response
    {
         // Récupérer toutes les catégories
         $categories = $categorieRepository->findAll();

         // Initialiser un tableau pour stocker les offres par catégorie
         $offresParCategorie = [];
 
         // Pour chaque catégorie, récupérer les offres d'emploi correspondantes
         foreach ($categories as $categorie) {
             // Récupérer les offres d'emploi pour cette catégorie
             $offresParCategorie[$categorie->getCategorie()] = $offresRepository->findByCategorie($categorie);
         }
        return $this->render('home/index.html.twig', [
            'offresParCategorie' => $offresParCategorie, // Passer les offres groupées par catégorie au modèle Twig
            'categories' => $categories, // Passer toutes les catégories pour afficher les filtres
        ]);
    }
}
