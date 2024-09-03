<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class VaccineController extends AbstractController
{
    #[Route('/vaccine', name: 'app_vaccine')]
    public function index(): Response
    {
        return $this->render('vaccine/index.html.twig', [
            'controller_name' => 'VaccineController',
        ]);
    }
}
