<?php

namespace App\Controller;

use App\Entity\Tarif;
use App\Form\TarifType;
use App\Repository\TarifRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/tarif")
 */
class TarifController extends Controller
{
    /**
     * @Route("/", name="back_tarif_index", methods="GET")
     */
    public function index(TarifRepository $tarifRepository): Response
    {
        return $this->render('back/tarif/index.html.twig', ['tarifs' => $tarifRepository->findAll()]);
    }

    /**
     * @Route("/new", name="back_tarif_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $tarif = new Tarif();
        $form = $this->createForm(TarifType::class, $tarif);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tarif);
            $em->flush();
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_tarif_index');
        }

        return $this->render('back/tarif/new.html.twig', [
            'tarif' => $tarif,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/show", name="back_tarif_show", methods="GET")
     */
    public function show(Tarif $tarif): Response
    {
        return $this->render('back/tarif/show.html.twig', ['tarif' => $tarif]);
    }

    /**
     * @Route("/{id}/edit", name="back_tarif_edit", methods="GET|POST")
     */
    public function edit(Request $request, Tarif $tarif): Response
    {
        $form = $this->createForm(TarifType::class, $tarif);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_tarif_edit', ['id' => $tarif->getId()]);
        }

        return $this->render('back/tarif/edit.html.twig', [
            'tarif' => $tarif,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="tarif_delete", methods="DELETE")
     */
    public function delete(Request $request, Tarif $tarif): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tarif->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tarif);
            $em->flush();
            $this->addFlash(
                'success',
                'Suppression efféctué avec succès!'
            );
        }

        return $this->redirectToRoute('back_tarif_index');
    }
}
