<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Marques;
use App\Entity\Produits;
use App\Entity\Commandes;
use App\Entity\TailleStock;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Wethenewnew')
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Homepage', 'fas fa-home', 'app_home');
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Products', 'fas fa-industry', Produits::class);
        yield MenuItem::linkToCrud('User', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Commandes', 'fas fa-paper-plane-o', Commandes::class);
        yield MenuItem::linkToCrud('Marques', 'fas fa-building', Marques::class);
        yield MenuItem::linkToCrud('Stocks', 'fas fa-list-ol ', TailleStock::class);
    }
}
