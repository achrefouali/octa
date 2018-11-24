<?php

namespace App\Controller;

use App\Entity\Hotel;
use App\Form\HotelType;
use App\Repository\HotelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/hotel")
 */
class HotelController extends Controller
{
    /**
     * @Route("/", name="back_hotel_index", methods="GET")
     */
    public function index(HotelRepository $hotelRepository): Response
    {
        return $this->render('back/hotel/index.html.twig', ['hotels' => $hotelRepository->findAll()]);
    }

    /**
     * @Route("/new", name="back_hotel_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $hotel = new Hotel();
        $form = $this->createForm(HotelType::class, $hotel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($hotel);
            $em->flush();
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_hotel_index');
        }

        return $this->render('back/hotel/new.html.twig', [
            'hotel' => $hotel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="back_hotel_show", methods="GET")
     */
    public function show(Hotel $hotel): Response
    {
        return $this->render('back/hotel/show.html.twig', ['hotel' => $hotel]);
    }

    /**
     * @Route("/{id}/edit", name="back_hotel_edit", methods="GET|POST")
     */
    public function edit(Request $request, Hotel $hotel): Response
    {
        $form = $this->createForm(HotelType::class, $hotel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_hotel_edit', ['id' => $hotel->getId()]);
        }

        return $this->render('back/hotel/edit.html.twig', [
            'hotel' => $hotel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="back_hotel_delete", methods="DELETE")
     */
    public function delete(Request $request, Hotel $hotel): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hotel->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($hotel);
            $em->flush();
            $this->addFlash(
                'success',
                'Suppression efféctué avec succès!'
            );
        }

        return $this->redirectToRoute('back_hotel_index');
    }
}
