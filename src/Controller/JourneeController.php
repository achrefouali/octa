<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\Journee;
use App\Form\JourneeType;
use App\Repository\JourneeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/journee")
 */
class JourneeController extends Controller
{
    /**
     * @Route("/{event}", name="back_journee_index", methods="GET")
     */
    public function index(JourneeRepository $journeeRepository, Event $event): Response
    {
        return $this->render('back/journee/index.html.twig', [
            'journees' => $journeeRepository->findBy(['event' => $event]),
            'event' => $event
        ]);
    }

    /**
     * @Route("/{event}/new", name="back_journee_new", methods="GET|POST")
     */
    public function new(Request $request, Event $event): Response
    {
        $journee = new Journee();
        $form = $this->createForm(JourneeType::class, $journee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $journee->setEvent($event);

            $em->persist($journee);
            $em->flush();
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_journee_index', ['event' => $event->getId()]);
        }

        return $this->render('back/journee/new.html.twig', [
            'event' => $event,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/show", name="back_journee_show", methods="GET")
     */
    public function show(Journee $journee): Response
    {
        return $this->render('back/journee/show.html.twig', [
            'journee' => $journee
        ]);
    }

    /**
     * @Route("/{id}/edit", name="back_journee_edit", methods="GET|POST")
     */
    public function edit(Request $request, Journee $journee): Response
    {
        $form = $this->createForm(JourneeType::class, $journee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_journee_edit', ['id' => $journee->getId()]);
        }

        return $this->render('back/journee/edit.html.twig', [
            'journee' => $journee,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="back_journee_delete", methods="DELETE")
     */
    public function delete(Request $request, Journee $journee): Response
    {
        if ($this->isCsrfTokenValid('delete'.$journee->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($journee);
            $em->flush();
            $this->addFlash(
                'success',
                'Suppression efféctué avec succès!'
            );
        }

        return $this->redirectToRoute('back_journee_index', ['event' => $journee->getEvent()]);
    }
}
