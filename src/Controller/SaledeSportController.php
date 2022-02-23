<?php

namespace App\Controller;

use App\Entity\Saledesport;
use App\Form\SaledeSportType;
use App\Repository\SaledeSportRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/salede/sport")
 */
class SaledeSportController extends AbstractController
{
    /**
     * @Route("/", name="salede_sport_index", methods={"GET"})
     */
    public function index(SaledeSportRepository $saledeSportRepository): Response
    {
        return $this->render('salede_sport/index.html.twig', [
            'salede_sports' => $saledeSportRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="salede_sport_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $saledeSport = new SaledeSport();
        $form = $this->createForm(SaledeSportType::class, $saledeSport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($saledeSport);
            $entityManager->flush();

            return $this->redirectToRoute('salede_sport_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('salede_sport/new.html.twig', [
            'salede_sport' => $saledeSport,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="salede_sport_show", methods={"GET"})
     */
    public function show(SaledeSport $saledeSport): Response
    {
        return $this->render('salede_sport/show.html.twig', [
            'salede_sport' => $saledeSport,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="salede_sport_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, SaledeSport $saledeSport, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SaledeSportType::class, $saledeSport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('salede_sport_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('salede_sport/edit.html.twig', [
            'salede_sport' => $saledeSport,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="salede_sport_delete", methods={"POST"})
     */
    public function delete(Request $request, SaledeSport $saledeSport, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$saledeSport->getId(), $request->request->get('_token'))) {
            $entityManager->remove($saledeSport);
            $entityManager->flush();
        }

        return $this->redirectToRoute('salede_sport_index', [], Response::HTTP_SEE_OTHER);
    }
}
