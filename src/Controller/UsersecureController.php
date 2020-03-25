<?php

namespace App\Controller;

use App\Entity\Usersecure;
use App\Form\UsersecureType;
use App\Repository\UsersecureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/usersecure")
 */
class UsersecureController extends AbstractController
{
    /**
     * @Route("/", name="usersecure_index", methods={"GET"})
     */
    public function index(UsersecureRepository $usersecureRepository): Response
    {
        return $this->render('usersecure/index.html.twig', [
            'usersecures' => $usersecureRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="usersecure_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $usersecure = new Usersecure();
        $form = $this->createForm(UsersecureType::class, $usersecure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $usersecure->setRoles(['ROLE_USER']);
            $usersecure->setIsActive(FALSE);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($usersecure);
            $entityManager->flush();

            return $this->redirectToRoute('usersecure_index');
        }

        return $this->render('usersecure/new.html.twig', [
            'usersecure' => $usersecure,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="usersecure_show", methods={"GET"})
     */
    public function show(Usersecure $usersecure): Response
    {
        return $this->render('usersecure/show.html.twig', [
            'usersecure' => $usersecure,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="usersecure_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Usersecure $usersecure): Response
    {
        $form = $this->createForm(UsersecureType::class, $usersecure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('usersecure_index');
        }

        return $this->render('usersecure/edit.html.twig', [
            'usersecure' => $usersecure,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="usersecure_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Usersecure $usersecure): Response
    {
        if ($this->isCsrfTokenValid('delete'.$usersecure->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($usersecure);
            $entityManager->flush();
        }

        return $this->redirectToRoute('usersecure_index');
    }
}
