<?php

namespace App\Controller;

use App\Entity\HotelCategorie;
use App\Form\HotelCategorieType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/hotel/categorie")
 */
class HotelCategorieController extends Controller
{
    /**
     * @Route("/", name="back_hotel_categorie_index", methods="GET")
     */
    public function index(): Response
    {
        $hotelCategories = $this->getDoctrine()
            ->getRepository(HotelCategorie::class)
            ->findAll();

        return $this->render('back/hotel_categorie/index.html.twig', ['hotel_categories' => $hotelCategories]);
    }

    /**
     * @Route("/new", name="back_hotel_categorie_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $hotelCategorie = new HotelCategorie();
        $form = $this->createForm(HotelCategorieType::class, $hotelCategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($hotelCategorie);
            $em->flush();
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_hotel_categorie_index');
        }

        return $this->render('back/hotel_categorie/new.html.twig', [
            'hotel_categorie' => $hotelCategorie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="back_hotel_categorie_show", methods="GET")
     */
    public function show(HotelCategorie $hotelCategorie): Response
    {
        return $this->render('back/hotel_categorie/show.html.twig', ['hotel_categorie' => $hotelCategorie]);
    }

    /**
     * @Route("/{id}/edit", name="back_hotel_categorie_edit", methods="GET|POST")
     */
    public function edit(Request $request, HotelCategorie $hotelCategorie): Response
    {
        $form = $this->createForm(HotelCategorieType::class, $hotelCategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_hotel_categorie_edit', ['id' => $hotelCategorie->getId()]);
        }

        return $this->render('back/hotel_categorie/edit.html.twig', [
            'hotel_categorie' => $hotelCategorie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="back_hotel_categorie_delete", methods="DELETE")
     */
    public function delete(Request $request, HotelCategorie $hotelCategorie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hotelCategorie->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($hotelCategorie);
            $em->flush();
            $this->addFlash(
                'success',
                'Suppression efféctué avec succès!'
            );
        }

        return $this->redirectToRoute('back_hotel_categorie_index');
    }
}
