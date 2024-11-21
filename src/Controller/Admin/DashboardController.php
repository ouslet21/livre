<?php

namespace App\Controller\Admin;

use App\Entity\Auteur;
use App\Entity\Editeur;
use App\Entity\Livre; // Add entities that will have CRUD interfaces
use App\Entity\Categorie;
use App\Entity\Utilisateur;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');

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
        // return $this->render('some/path/my-dashboard.html.twig');
    }


    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Gestion des Emprunts')
            //->setFaviconPath('favicon.ico') // Set a custom favicon path
            ->setTextDirection('ltr')       // Use 'rtl' for right-to-left languages
            ->renderContentMaximized()      // Full-width content area
            ->disableDarkMode()              // Disable dark mode if undesired
            ->setDefaultColorScheme('dark')
            ;

    }

    public function configureMenuItems(): iterable
    {
        // Link to the main Dashboard page
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fa fa-users', Utilisateur::class);

        yield MenuItem::section('Gestion Librairie');
        // CRUD Links to entities for easy access
        yield MenuItem::linkToCrud('Livres', 'fas fa-book', Livre::class);
        yield MenuItem::linkToCrud('Categories', 'fas fa-tags', Categorie::class);
        yield MenuItem::linkToCrud('Auteurs', 'fas fa-user', Auteur::class);
        yield MenuItem::linkToCrud('Editeurs', 'fas fa-building', Editeur::class);

        // Additional Custom Links or Submenus
        yield MenuItem::section('Settings');
        yield MenuItem::linkToRoute('User Profile', 'fas fa-user', 'app_user_profile');
        // Link to registration page
        //yield MenuItem::linkToRoute('Register User', 'fas fa-user-plus', 'app_register');
        yield MenuItem::linkToLogout('Logout', 'fas fa-sign-out-alt'); // Adds a logout option

        // Link to external resources
        yield MenuItem::section('Resources');
        yield MenuItem::linkToUrl('Documentation', 'fas fa-book-open', 'https://example.com/docs');
        yield MenuItem::linkToUrl('Support', 'fas fa-life-ring', 'https://example.com/support');
    }
}
