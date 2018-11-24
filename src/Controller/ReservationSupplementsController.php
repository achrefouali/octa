<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\ReservationSupplements;
use App\Form\ReservationSupplementsType;
use App\Repository\ReservationSupplementsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/reservation/supplements")
 */
class ReservationSupplementsController extends Controller
{
    /**
     * @Route("/", name="back_reservation_supplements_index", methods="GET")
     */
    public function index(ReservationSupplementsRepository $reservationSupplementsRepository): Response
    {
        return $this->render('back/reservation_supplements/index.html.twig', [
            'reservation_supplements' => $reservationSupplementsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{reservation}/new", name="back_reservation_supplements_new", methods="GET|POST")
     */
    public function new(Request $request, Reservation $reservation): Response
    {
        $reservationSupplement = new ReservationSupplements();
        $paymentMethods = $this->getParameter('paymentMethod');
        $form = $this->createForm(ReservationSupplementsType::class, $reservationSupplement, [
            'paymentMethods' => $paymentMethods
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $reservationSupplement->setReservation($reservation);

            $em->persist($reservationSupplement);
            $em->flush();
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_reservation_supplements_index', ['reservation' => $reservation->getId()]);
        }

        return $this->render('back/reservation_supplements/new.html.twig', [
            'reservation_supplement' => $reservationSupplement,
            'form' => $form->createView(),
            'reservation' => $reservation
        ]);
    }

    /**
     * @Route("/{id}/show", name="back_reservation_supplements_show", methods="GET")
     */
    public function show(ReservationSupplements $reservationSupplement): Response
    {
        return $this->render('back/reservation_supplements/show.html.twig', ['reservation_supplement' => $reservationSupplement]);
    }

    /**
     * @Route("/{id}/edit", name="back_reservation_supplements_edit", methods="GET|POST")
     */
    public function edit(Request $request, ReservationSupplements $reservationSupplement): Response
    {
        $paymentMethods = $this->getParameter('paymentMethod');
        $form = $this->createForm(ReservationSupplementsType::class, $reservationSupplement, [
            'paymentMethods' => $paymentMethods
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_reservation_supplements_edit', ['id' => $reservationSupplement->getId()]);
        }

        return $this->render('back/reservation_supplements/edit.html.twig', [
            'reservation_supplement' => $reservationSupplement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="back_reservation_supplements_delete", methods="DELETE")
     */
    public function delete(Request $request, ReservationSupplements $reservationSupplement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservationSupplement->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($reservationSupplement);
            $em->flush();
            $this->addFlash(
                'success',
                'Suppression efféctué avec succès!'
            );
        }

        return $this->redirectToRoute('back_reservation_supplements_index', ['reservation' => $reservationSupplement->getReservation()->getId()]);
    }
}
