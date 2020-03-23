<?php

namespace App\Controller;

use App\Entity\Barrow;
use App\Form\BarrowType;
use App\Repository\BarrowRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/barrow")
 */
class BarrowController extends AbstractController
{
    /**
     * @Route("/", name="barrow_index", methods={"GET"})
     */
    public function index(BarrowRepository $barrowRepository): Response
    {
        return $this->render('barrow/index.html.twig', [
            'barrows' => $barrowRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="barrow_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $barrow = new Barrow();
        $form = $this->createForm(BarrowType::class, $barrow);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($barrow);
            $entityManager->flush();

            return $this->redirectToRoute('barrow_index');
        }

        return $this->render('barrow/new.html.twig', [
            'barrow' => $barrow,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="barrow_show", methods={"GET"})
     */
    public function show(Barrow $barrow): Response
    {
        return $this->render('barrow/show.html.twig', [
            'barrow' => $barrow,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="barrow_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Barrow $barrow): Response
    {
        $form = $this->createForm(BarrowType::class, $barrow);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('barrow_index');
        }

        return $this->render('barrow/edit.html.twig', [
            'barrow' => $barrow,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="barrow_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Barrow $barrow): Response
    {
        if ($this->isCsrfTokenValid('delete'.$barrow->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($barrow);
            $entityManager->flush();
        }

        return $this->redirectToRoute('barrow_index');
    }
}
