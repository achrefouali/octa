<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\ReservationHotel;
use App\Form\ReservationHotelType;
use App\Repository\ReservationHotelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/reservation/hotel")
 */
class ReservationHotelController extends Controller
{
    /**
     * @Route("/", name="back_reservation_hotel_index", methods="GET")
     */
    public function index(ReservationHotelRepository $reservationHotelRepository): Response
    {
        return $this->render('back/reservation_hotel/index.html.twig', [
            'reservation_hotels' => $reservationHotelRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{reservation}/new", name="back_reservation_hotel_new", methods="GET|POST")
     */
    public function new(Request $request, Reservation $reservation): Response
    {
        $reservationHotel = new ReservationHotel();
        $paymentMethods = $this->getParameter('paymentMethod');
        $form = $this->createForm(ReservationHotelType::class, $reservationHotel, [
            'paymentMethods' => $paymentMethods
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $reservationHotel->setReservation($reservation);

            $em->persist($reservationHotel);
            $em->flush();
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_reservation_hotel_index', ['reservation' => $reservation->getId()]);
        }

        return $this->render('back/reservation_hotel/new.html.twig', [
            'reservation_hotel' => $reservationHotel,
            'form' => $form->createView(),
            'reservation' => $reservation
        ]);
    }

    /**
     * @Route("/{id}/show", name="back_reservation_hotel_show", methods="GET")
     */
    public function show(ReservationHotel $reservationHotel): Response
    {
        return $this->render('back/reservation_hotel/show.html.twig', ['reservation_hotel' => $reservationHotel]);
    }

    /**
     * @Route("/{id}/edit", name="back_reservation_hotel_edit", methods="GET|POST")
     */
    public function edit(Request $request, ReservationHotel $reservationHotel): Response
    {
        $paymentMethods = $this->getParameter('paymentMethod');
        $paymentType = $this->getParameter('paymentType');
        $currencyType = $this->getParameter('currencyType');
        $participant=$reservationHotel->getReservation()->getParticipant();
        $reservation=$reservationHotel->getReservation();
        $state=$reservationHotel->getReservation()->getState();
        $stateFormatted = $reservationHotel->getReservation()->getFormattedState();
        $form = $this->createForm(ReservationHotelType::class, $reservationHotel, [
            'paymentMethods' => $paymentMethods,
            'participant'=>$participant,
            'reservation'=>$reservation,
            'state'=>$stateFormatted,
            'paymentType'=>$paymentType,
            'currencyType'=>$currencyType,

        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            if($request->request->has('subsribeConfirmedWaiting')){
                $reservationHotel->getReservation()->setState(2);
            }
            if($request->request->has('rejected')){
                $reservationHotel->getReservation()->setState(4);
            }
            if($request->request->has('subsribeConfirmedPayed')){
                $reservationHotel->getReservation()->setState(1);
            }
            if($request->request->has('offred')){
                $reservationHotel->getReservation()->setState(8);
            }



            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_reservation_hotel_edit', ['id' => $reservationHotel->getId()]);
        }

        return $this->render('back/reservation_hotel/edit.html.twig', [
            'reservation_hotel' => $reservationHotel,
            'form' => $form->createView(),
            'state'=>$state
        ]);
    }

    /**
     * @Route("/{id}/delete", name="back_reservation_hotel_delete", methods="DELETE")
     */
    public function delete(Request $request, ReservationHotel $reservationHotel): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservationHotel->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($reservationHotel);
            $em->flush();
            $this->addFlash(
                'success',
                'Suppression efféctué avec succès!'
            );
        }

        return $this->redirectToRoute('back_reservation_hotel_index', ['reservation' => $reservationHotel->getReservation()->getId()]);
    }
}
