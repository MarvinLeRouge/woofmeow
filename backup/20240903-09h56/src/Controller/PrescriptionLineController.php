<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PrescriptionLineController extends AbstractController
{
    #[Route('/prescription/line', name: 'app_prescription_line')]
    public function index(): Response
    {
        return $this->render('prescription_line/index.html.twig', [
            'controller_name' => 'PrescriptionLineController',
        ]);
    }
}
