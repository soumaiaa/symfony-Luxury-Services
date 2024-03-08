<?php

namespace App\Controller\Admin;

use App\Entity\Candidats;
use App\Entity\Categorie;
use App\Entity\Category;
use App\Entity\Clients;
use App\Entity\Experience;
use App\Entity\Gender;
use App\Entity\Media;
use App\Entity\Offres;
use App\Entity\TypeContract;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Symfony Luxury Services');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Manage Clients', 'fa-solid fa-landmark', Clients::class);
        yield MenuItem::linkToCrud('Manage Offres', 'fa-sharp fa-solid fa-briefcase', Offres::class);
        yield MenuItem::linkToCrud('Manage Candidats', 'fa-solid fa-graduation-cap', Candidats::class);
        yield MenuItem::linkToCrud('Manage Categorie', 'fa-solid fa-layer-group', Categorie::class);
        yield MenuItem::linkToCrud('Manage Experience', 'fa-solid fa-code', Experience::class);
        yield MenuItem::linkToCrud('Manage Media', 'fa-solid fa-folder-open', Media::class);
        yield MenuItem::linkToCrud('Manage typeCantract', 'fa-solid fa-file-signature', TypeContract::class);
        yield MenuItem::linkToCrud('Manage User', 'fa-solid fa-users', User::class);
        yield MenuItem::linkToCrud('Manage Gender', 'fa-solid fa-venus-mars', Gender::class);
    }
 
}