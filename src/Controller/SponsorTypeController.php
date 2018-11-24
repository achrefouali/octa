<?php

namespace App\Controller;

use App\Entity\SponsorType;
use App\Form\SponsorType1Type;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/sponsor/type")
 */
class SponsorTypeController extends Controller
{
    /**
     * @Route("/", name="back_sponsor_type_index", methods="GET")
     */
    public function index(): Response
    {
        $sponsorTypes = $this->getDoctrine()
            ->getRepository(SponsorType::class)
            ->findAll();

        return $this->render('back/sponsor_type/index.html.twig', ['sponsor_types' => $sponsorTypes]);
    }

    /**
     * @Route("/new", name="back_sponsor_type_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $sponsorType = new SponsorType();
        $form = $this->createForm(SponsorType1Type::class, $sponsorType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sponsorType);
            $em->flush();
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_sponsor_type_index');
        }

        return $this->render('back/sponsor_type/new.html.twig', [
            'sponsor_type' => $sponsorType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="back_sponsor_type_show", methods="GET")
     */
    public function show(SponsorType $sponsorType): Response
    {
        return $this->render('back/sponsor_type/show.html.twig', ['sponsor_type' => $sponsorType]);
    }

    /**
     * @Route("/{id}/edit", name="back_sponsor_type_edit", methods="GET|POST")
     */
    public function edit(Request $request, SponsorType $sponsorType): Response
    {
        $form = $this->createForm(SponsorType1Type::class, $sponsorType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_sponsor_type_edit', ['id' => $sponsorType->getId()]);
        }

        return $this->render('back/sponsor_type/edit.html.twig', [
            'sponsor_type' => $sponsorType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="back_sponsor_type_delete", methods="DELETE")
     */
    public function delete(Request $request, SponsorType $sponsorType): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sponsorType->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sponsorType);
            $em->flush();
            $this->addFlash(
                'success',
                'Suppression efféctué avec succès!'
            );
        }

        return $this->redirectToRoute('back_sponsor_type_index');
    }
}
