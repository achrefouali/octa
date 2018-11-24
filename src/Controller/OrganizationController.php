<?php

namespace App\Controller;

use App\Entity\Organization;
use App\Form\OrganizationType;
use App\Repository\OrganizationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


/**
 * @Route("/back/organizme")
 */
class OrganizationController extends Controller
{
    /**
     * @Route("/", name="back_organizme_index")
     */
    public function index(OrganizationRepository $organizationRepository)
    {
        return $this->render('back/organization/index.html.twig', ['organizations' => $organizationRepository->findAll()]);

    }

    /**
     * @Route("/new", name="back_organizme_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $organization = new Organization();
        $form = $this->createForm(OrganizationType::class, $organization);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($organization);
            $em->flush();
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_organizme_index');
        }

        return $this->render('back/organization/new.html.twig', [
            'organizme' => $organization,
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/{id}/edit", name="back_organizme_edit", methods="GET|POST")
     */
    public function edit(Request $request, Organization $organization): Response
    {

        //end upload file

        $form = $this->createForm(OrganizationType::class, $organization);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($organization);
            $em->flush();
           
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_organizme_edit', ['id' => $organization->getId()]);
        }

        return $this->render('back/organization/edit.html.twig', [
            'organizme' => $organization,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="back_organisme_show", methods="GET")
     */
    public function show(Organization $organisme): Response
    {
        return $this->render('back/organization/show.html.twig', ['organisme' => $organisme]);
    }
}
