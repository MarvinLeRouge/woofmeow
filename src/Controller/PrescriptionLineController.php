<?php

namespace App\Controller;

use App\Entity\PrescriptionLine;
use App\Form\PrescriptionLineType;
use App\Repository\PrescriptionLineRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/prescription/line')]
class PrescriptionLineController extends AbstractController
{
    #[Route('/', name: 'app_prescription_line_index', methods: ['GET'])]
    public function index(PrescriptionLineRepository $prescriptionLineRepository): Response
    {
        return $this->render('prescription_line/index.html.twig', [
            'prescription_lines' => $prescriptionLineRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_prescription_line_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $prescriptionLine = new PrescriptionLine();
        $form = $this->createForm(PrescriptionLineType::class, $prescriptionLine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($prescriptionLine);
            $entityManager->flush();

            return $this->redirectToRoute('app_prescription_line_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('prescription_line/new.html.twig', [
            'prescription_line' => $prescriptionLine,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_prescription_line_show', methods: ['GET'])]
    public function show(PrescriptionLine $prescriptionLine): Response
    {
        return $this->render('prescription_line/show.html.twig', [
            'prescription_line' => $prescriptionLine,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_prescription_line_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PrescriptionLine $prescriptionLine, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PrescriptionLineType::class, $prescriptionLine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_prescription_line_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('prescription_line/edit.html.twig', [
            'prescription_line' => $prescriptionLine,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_prescription_line_delete', methods: ['POST'])]
    public function delete(Request $request, PrescriptionLine $prescriptionLine, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$prescriptionLine->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($prescriptionLine);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_prescription_line_index', [], Response::HTTP_SEE_OTHER);
    }
}
