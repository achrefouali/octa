<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\Journee;
use App\Entity\Programme;
use App\Form\ProgrammeType;
use App\Repository\ProgrammeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/programme")
 */
class ProgrammeController extends Controller
{
    /**
     * @Route("/{journee}", name="back_programme_index", methods="GET")
     */
    public function index(ProgrammeRepository $programmeRepository, Journee $journee): Response
    {
        return $this->render('back/programme/index.html.twig', [
            'journee' => $journee,
            'programmes' => $programmeRepository->findBy(['journee' => $journee->getId()])
        ]);
    }

    /**
     * @Route("/{journee}/new", name="back_programme_new", methods="GET|POST")
     */
    public function new(Request $request, Journee $journee): Response
    {
        $programme = new Programme();
        $form = $this->createForm(ProgrammeType::class, $programme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $programme->setJournee($journee);

            $em->persist($programme);
            $em->flush();
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_programme_index', ['journee' => $journee->getId()]);
        }

        return $this->render('back/programme/new.html.twig', [
            'journee' => $journee,
            'programme' => $programme,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/show", name="back_programme_show", methods="GET")
     */
    public function show(Programme $programme): Response
    {
        return $this->render('back/programme/show.html.twig', ['programme' => $programme]);
    }

    /**
     * @Route("/{id}/edit", name="back_programme_edit", methods="GET|POST")
     */
    public function edit(Request $request, Programme $programme): Response
    {
        $form = $this->createForm(ProgrammeType::class, $programme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_programme_edit', [
                'journee' => $programme->getJournee(),
                'id' => $programme->getId()
            ]);
        }

        return $this->render('back/programme/edit.html.twig', [
            'programme' => $programme,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="back_programme_delete", methods="DELETE")
     */
    public function delete(Request $request, Programme $programme): Response
    {
        if ($this->isCsrfTokenValid('delete'.$programme->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($programme);
            $em->flush();
            $this->addFlash(
                'success',
                'Suppression efféctué avec succès!'
            );
        }

        return $this->redirectToRoute('back_programme_index', ['journee' => $programme->getJournee()->getId()]);
    }
}
