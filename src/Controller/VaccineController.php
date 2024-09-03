<?php

namespace App\Controller;

use App\Entity\Vaccine;
use App\Form\VaccineType;
use App\Repository\VaccineRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/vaccine')]
class VaccineController extends AbstractController
{
    #[Route('/', name: 'app_vaccine_index', methods: ['GET'])]
    public function index(VaccineRepository $vaccineRepository): Response
    {
        return $this->render('vaccine/index.html.twig', [
            'vaccines' => $vaccineRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_vaccine_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $vaccine = new Vaccine();
        $form = $this->createForm(VaccineType::class, $vaccine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($vaccine);
            $entityManager->flush();

            return $this->redirectToRoute('app_vaccine_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('vaccine/new.html.twig', [
            'vaccine' => $vaccine,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_vaccine_show', methods: ['GET'])]
    public function show(Vaccine $vaccine): Response
    {
        return $this->render('vaccine/show.html.twig', [
            'vaccine' => $vaccine,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_vaccine_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Vaccine $vaccine, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VaccineType::class, $vaccine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_vaccine_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('vaccine/edit.html.twig', [
            'vaccine' => $vaccine,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_vaccine_delete', methods: ['POST'])]
    public function delete(Request $request, Vaccine $vaccine, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vaccine->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($vaccine);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_vaccine_index', [], Response::HTTP_SEE_OTHER);
    }
}
