<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Animal;
use App\Entity\Visit;
use App\Entity\Vaccine;
use App\Entity\Prescription;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        //return parent::index();

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
            ->setTitle('Woofmeow');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::section('');
        yield MenuItem::linkToCrud('Clients', 'fa fa-user', User::class);
        yield MenuItem::linkToCrud('Animaux', 'fa fa-dog', Animal::class);
        yield MenuItem::linkToCrud('Visites', 'fa fa-user-doctor', Visit::class);
        yield MenuItem::linkToCrud('Vaccins', 'fa fa-syringe', Vaccine::class);
        yield MenuItem::linkToCrud('Prescriptions', 'fa fa-prescription-bottle-medical', Prescription::class);

        yield MenuItem::section('');
        yield MenuItem::linkToLogout('Logout', 'fa fa-door-open');
    }


}
