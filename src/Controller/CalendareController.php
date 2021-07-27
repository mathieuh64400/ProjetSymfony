<?php

namespace App\Controller;

use App\Entity\Calendare;
use App\Form\CalendareType;
use App\Repository\CalendareRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/calendare")
 */
class CalendareController extends AbstractController
{
    /**
     * @Route("/", name="calendare_index", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(CalendareRepository $calendareRepository): Response
    {
        return $this->render('calendare/index.html.twig', [
            'calendares' => $calendareRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="calendare_new", methods={"GET","POST"})
     * @IsGranted("ROLE_USER")
     */
    public function new(Request $request): Response
    {
        $calendare = new Calendare();
        $form = $this->createForm(CalendareType::class, $calendare);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($calendare);
            $entityManager->flush();
            if ('ROLE_ADMIN') {
                return $this->redirectToRoute('calendare_index');
            }else
            return $this->redirectToRoute('paccueil');
        }

        return $this->render('calendare/new.html.twig', [
            'calendare' => $calendare,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="calendare_show", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function show(Calendare $calendare): Response
    {
        return $this->render('calendare/show.html.twig', [
            'calendare' => $calendare,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="calendare_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, Calendare $calendare): Response
    {
        $form = $this->createForm(CalendareType::class, $calendare);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('calendare_index');
        }

        return $this->render('calendare/edit.html.twig', [
            'calendare' => $calendare,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="calendare_delete", methods={"DELETE"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, Calendare $calendare): Response
    {
        if ($this->isCsrfTokenValid('delete'.$calendare->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($calendare);
            $entityManager->flush();
        }

        return $this->redirectToRoute('calendare_index');
    }
}
