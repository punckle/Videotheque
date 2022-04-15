<?php

namespace App\Controller\Admin;

use App\Entity\Actor;
use App\Entity\Director;
use App\Entity\Movie;
use App\Entity\Platform;
use App\Entity\Type;
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
        return $this->render('admin/dashboard/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Vidéothèque');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-dashboard');
        yield MenuItem::linkToCrud('Movies', 'fa fa-film', Movie::class);
        yield MenuItem::linkToCrud('Directors', 'fa fa-video', Director::class);
        yield MenuItem::linkToCrud('Actors', 'fa fa-clapperboard', Actor::class);
        yield MenuItem::linkToCrud('Types', 'fa fa-list', Type::class);
        yield MenuItem::linkToCrud('Platforms', 'fa fa-question', Platform::class);
    }
}
