<?php

namespace App\Controller;

use App\Entity\Sections;
use App\Form\SectionsType;
use App\Repository\SectionsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/sections')]
class SectionsController extends AbstractController
{
    #[Route('/', name: 'app_sections_index', methods: ['GET'])]
    public function index(SectionsRepository $sectionsRepository): Response
    {
        return $this->render('sections/index.html.twig', [
            'sections' => $sectionsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_sections_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $section = new Sections();
        $form = $this->createForm(SectionsType::class, $section);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($section);
            $entityManager->flush();

            return $this->redirectToRoute('app_sections_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('sections/new.html.twig', [
            'section' => $section,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sections_show', methods: ['GET'])]
    public function show(Sections $section): Response
    {
        return $this->render('sections/show.html.twig', [
            'section' => $section,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_sections_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Sections $section, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SectionsType::class, $section);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_sections_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('sections/edit.html.twig', [
            'section' => $section,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sections_delete', methods: ['POST'])]
    public function delete(Request $request, Sections $section, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$section->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($section);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_sections_index', [], Response::HTTP_SEE_OTHER);
    }
}
