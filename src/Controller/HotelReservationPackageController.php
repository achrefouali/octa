<?php

namespace App\Controller;

use App\Entity\HotelReservationPackage;
use App\Form\HotelReservationPackageType;
use App\Repository\HotelReservationPackageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/hotel/reservation/package")
 */
class HotelReservationPackageController extends Controller
{
    /**
     * @Route("/", name="back_hotel_reservation_package_index", methods="GET")
     */
    public function index(HotelReservationPackageRepository $hotelReservationPackageRepository): Response
    {
        return $this->render('back/hotel_reservation_package/index.html.twig', ['hotel_reservation_packages' => $hotelReservationPackageRepository->findAll()]);
    }

    /**
     * @Route("/new", name="back_hotel_reservation_package_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $hotelReservationPackage = new HotelReservationPackage();
        $form = $this->createForm(HotelReservationPackageType::class, $hotelReservationPackage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($hotelReservationPackage);
            $em->flush();
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_hotel_reservation_package_index');
        }

        return $this->render('back/hotel_reservation_package/new.html.twig', [
            'hotel_reservation_package' => $hotelReservationPackage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="back_hotel_reservation_package_show", methods="GET")
     */
    public function show(HotelReservationPackage $hotelReservationPackage): Response
    {
        return $this->render('back/hotel_reservation_package/show.html.twig', ['hotel_reservation_package' => $hotelReservationPackage]);
    }

    /**
     * @Route("/{id}/edit", name="back_hotel_reservation_package_edit", methods="GET|POST")
     */
    public function edit(Request $request, HotelReservationPackage $hotelReservationPackage): Response
    {
        $form = $this->createForm(HotelReservationPackageType::class, $hotelReservationPackage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_hotel_reservation_package_edit', ['id' => $hotelReservationPackage->getId()]);
        }

        return $this->render('back/hotel_reservation_package/edit.html.twig', [
            'hotel_reservation_package' => $hotelReservationPackage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="back_hotel_reservation_package_delete", methods="DELETE")
     */
    public function delete(Request $request, HotelReservationPackage $hotelReservationPackage): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hotelReservationPackage->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($hotelReservationPackage);
            $em->flush();
            $this->addFlash(
                'success',
                'Suppression efféctué avec succès!'
            );
        }

        return $this->redirectToRoute('back_hotel_reservation_package_index');
    }
}
