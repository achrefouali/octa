<?php

namespace App\Controller;

use App\Entity\HotelPackage;
use App\Entity\HotelPackagePeriode;
use App\Form\HotelPackagePeriodeType;
use App\Repository\HotelPackagePeriodeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/hotel/package/periode")
 */
class HotelPackagePeriodeController extends Controller
{
    /**
     * @Route("/{package}", name="back_hotel_package_periode_index", methods="GET")
     */
    public function index(HotelPackagePeriodeRepository $hotelPackagePeriodeRepository, HotelPackage $package): Response
    {
        return $this->render('back/hotel_package_periode/index.html.twig', [
            'hotel_package_periodes' => $hotelPackagePeriodeRepository->findBy(['package' => $package]),
            'package' => $package
        ]);
    }

    /**
     * @Route("/{package}/new", name="back_hotel_package_periode_new", methods="GET|POST")
     */
    public function new(Request $request, HotelPackage $package): Response
    {
        $hotelPackagePeriode = new HotelPackagePeriode();
        $form = $this->createForm(HotelPackagePeriodeType::class, $hotelPackagePeriode);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $hotelPackagePeriode->setPackage($package);

            $em->persist($hotelPackagePeriode);
            $em->flush();
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_hotel_package_periode_index', ['package' => $package->getId()]);
        }

        return $this->render('back/hotel_package_periode/new.html.twig', [
            'hotel_package_periode' => $hotelPackagePeriode,
            'form' => $form->createView(),
            'package' => $package
        ]);
    }

    /**
     * @Route("/{id}/show", name="back_hotel_package_periode_show", methods="GET")
     */
    public function show(HotelPackagePeriode $hotelPackagePeriode): Response
    {
        return $this->render('back/hotel_package_periode/show.html.twig', ['hotel_package_periode' => $hotelPackagePeriode]);
    }

    /**
     * @Route("/{id}/edit", name="back_hotel_package_periode_edit", methods="GET|POST")
     */
    public function edit(Request $request, HotelPackagePeriode $hotelPackagePeriode): Response
    {
        $form = $this->createForm(HotelPackagePeriodeType::class, $hotelPackagePeriode);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_hotel_package_periode_edit', ['id' => $hotelPackagePeriode->getId()]);
        }

        return $this->render('back/hotel_package_periode/edit.html.twig', [
            'hotel_package_periode' => $hotelPackagePeriode,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="back_hotel_package_periode_delete", methods="DELETE")
     */
    public function delete(Request $request, HotelPackagePeriode $hotelPackagePeriode): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hotelPackagePeriode->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($hotelPackagePeriode);
            $em->flush();
            $this->addFlash(
                'success',
                'Suppression efféctué avec succès!'
            );
        }

        return $this->redirectToRoute('back_hotel_package_periode_index', ['package' => $hotelPackagePeriode->getPackage()->getId()]);
    }
}
