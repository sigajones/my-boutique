<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Produit;
use App\Entity\Commande;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    public function __construct(private AdminUrlGenerator $adminUrlGenerator)
    {
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // creer un Url vers une page crud d'une entité
        $url = $this->adminUrlGenerator->setController(ProduitCrudController::class)->generateUrl();
        //redirige la page d'accueil du backoffice vers ce crud
        return $this->redirect($url);

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('My Boutique');
    }

    public function configureMenuItems(): iterable
    {
        // yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
        return [
            MenuItem::linkToDashboard("BACKOFFICE", 'fa fa-home'),
            MenuItem::section('Membre'),
            MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', User::class),
            MenuItem::linkToCrud('Produit', 'fa fa-newspaper', Produit::class),
            MenuItem::linkToCrud('Commandes', 'fa fa-cart', Commande::class),
            // ->setSubItems([
            //     MenuItem::linkToCrud('Categorie', 'fa fa-layer-group', Category::class),
            //     MenuItem::linkToCrud('Articles', 'fa fa-book', Article::class),
            //     MenuItem::linkToCrud('Commentaires', 'fa fa-comment', Comment::class),
            // ]),
            MenuItem::section('Retour au site'),
            MenuItem::linkToRoute('Accueil du site', 'fa fa-igloo', 'home'),
        ];
    }
}
