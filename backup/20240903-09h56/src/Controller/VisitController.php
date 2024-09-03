<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class VisitController extends AbstractController
{
    #[Route('/visit', name: 'app_visit')]
    public function index(): Response
    {
        return $this->render('visit/index.html.twig', [
            'controller_name' => 'VisitController',
        ]);
    }
}
