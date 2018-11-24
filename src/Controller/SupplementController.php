<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\Supplement;
use App\Form\SupplementType;
use App\Repository\SupplementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/supplement")
 */
class SupplementController extends Controller
{
    /**
     * @Route("/{event}", name="back_supplement_index", methods="GET", requirements={"event": "\d+"})
     */
    public function index(SupplementRepository $supplementRepository, Event $event): Response
    {
        return $this->render('back/supplement/index.html.twig', [
            'event' => $event,
            'supplements' => $supplementRepository->findBy(['event' => $event->getId()])
        ]);
    }

    /**
     *
     * @Route("/{event}/new", name="back_supplement_new", methods="GET|POST", requirements={"event": "\d+"})
     */
    public function new(Request $request, Event $event): Response
    {
        $supplement = new Supplement();
        $form = $this->createForm(SupplementType::class, $supplement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($supplement);
            $em->flush();
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_supplement_index', ['event' => $event->getId()]);
        }

        return $this->render('back/supplement/new.html.twig', [
            'event' => $event,
            'supplement' => $supplement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/show", name="back_supplement_show", methods="GET")
     */
    public function show(Supplement $supplement): Response
    {
        return $this->render('back/supplement/show.html.twig', ['supplement' => $supplement]);
    }

    /**
     * @Route("/{id}/edit", name="back_supplement_edit", methods="GET|POST")
     */
    public function edit(Request $request, Supplement $supplement): Response
    {
        $form = $this->createForm(SupplementType::class, $supplement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_supplement_edit', ['id' => $supplement->getId()]);
        }

        return $this->render('back/supplement/edit.html.twig', [
            'supplement' => $supplement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="back_supplement_delete", methods="DELETE")
     */
    public function delete(Request $request, Supplement $supplement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$supplement->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($supplement);
            $em->flush();
            $this->addFlash(
                'success',
                'Suppression efféctué avec succès!'
            );
        }

        return $this->redirectToRoute('back_supplement_index');
    }
}
