<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\ReservationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/reservation")
 */
class ReservationController extends Controller
{
    /**
     * @Route("/", name="back_reservation_index", methods="GET")
     */
    public function index(): Response
    {
        $reservations = $this->getDoctrine()
            ->getRepository(Reservation::class)
            ->findAll();

        return $this->render('back/reservation/index.html.twig', ['reservations' => $reservations]);
    }

    /**
     * @Route("/new", name="back_reservation_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $reservation = new Reservation();
        $states = $this->getParameter('reservation_state');
        $form = $this->createForm(ReservationType::class, $reservation, [
            'states' => $states
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reservation);
            $em->flush();
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_reservation_index');
        }

        return $this->render('back/reservation/new.html.twig', [
            'reservation' => $reservation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="back_reservation_show", methods="GET")
     */
    public function show(Reservation $reservation): Response
    {
        return $this->render('back/reservation/show.html.twig', ['reservation' => $reservation]);
    }

    /**
     * @Route("/{id}/edit", name="back_reservation_edit", methods="GET|POST")
     */
    public function edit(Request $request, Reservation $reservation): Response
    {

        $states = $this->getParameter('reservation_state');
        $form = $this->createForm(ReservationType::class, $reservation, [
            'states' => $states
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_reservation_edit', ['id' => $reservation->getId()]);
        }

        return $this->render('back/reservation/edit.html.twig', [
            'reservation' => $reservation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="back_reservation_delete", methods="DELETE")
     */
    public function delete(Request $request, Reservation $reservation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservation->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($reservation);
            $em->flush();
            $this->addFlash(
                'success',
                'Suppression efféctué avec succès!'
            );
        }

        return $this->redirectToRoute('back_reservation_index');
    }
}
