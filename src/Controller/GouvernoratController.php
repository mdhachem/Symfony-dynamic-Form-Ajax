<?php

namespace App\Controller;

use App\Entity\Gouvernorat;
use App\Form\GouvernoratType;
use App\Repository\GouvernoratRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/gouvernorat")
 */
class GouvernoratController extends AbstractController
{
    /**
     * @Route("/", name="gouvernorat_index", methods={"GET"})
     */
    public function index(GouvernoratRepository $gouvernoratRepository): Response
    {
        return $this->render('gouvernorat/index.html.twig', [
            'gouvernorats' => $gouvernoratRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="gouvernorat_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $gouvernorat = new Gouvernorat();
        $form = $this->createForm(GouvernoratType::class, $gouvernorat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($gouvernorat);
            $entityManager->flush();

            return $this->redirectToRoute('gouvernorat_index');
        }

        return $this->render('gouvernorat/new.html.twig', [
            'gouvernorat' => $gouvernorat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="gouvernorat_show", methods={"GET"})
     */
    public function show(Gouvernorat $gouvernorat): Response
    {
        return $this->render('gouvernorat/show.html.twig', [
            'gouvernorat' => $gouvernorat,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="gouvernorat_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Gouvernorat $gouvernorat): Response
    {
        $form = $this->createForm(GouvernoratType::class, $gouvernorat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('gouvernorat_index', [
                'id' => $gouvernorat->getId(),
            ]);
        }

        return $this->render('gouvernorat/edit.html.twig', [
            'gouvernorat' => $gouvernorat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="gouvernorat_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Gouvernorat $gouvernorat): Response
    {
        if ($this->isCsrfTokenValid('delete'.$gouvernorat->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($gouvernorat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('gouvernorat_index');
    }
}
