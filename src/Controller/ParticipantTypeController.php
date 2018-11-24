<?php

namespace App\Controller;

use App\Entity\ParticipantType;
use App\Form\ParticipantType1Type;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/participant/type")
 */
class ParticipantTypeController extends Controller
{
    /**
     * @Route("/", name="back_participant_type_index", methods="GET")
     */
    public function index(): Response
    {
        $participantTypes = $this->getDoctrine()
            ->getRepository(ParticipantType::class)
            ->findAll();

        return $this->render('back/participant_type/index.html.twig', ['participant_types' => $participantTypes]);
    }

    /**
     * @Route("/new", name="back_participant_type_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $participantType = new ParticipantType();
        $form = $this->createForm(ParticipantType1Type::class, $participantType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($participantType);
            $em->flush();
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_participant_type_index');
        }

        return $this->render('back/participant_type/new.html.twig', [
            'participant_type' => $participantType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="back_participant_type_show", methods="GET")
     */
    public function show(ParticipantType $participantType): Response
    {
        return $this->render('back/participant_type/show.html.twig', ['participant_type' => $participantType]);
    }

    /**
     * @Route("/{id}/edit", name="back_participant_type_edit", methods="GET|POST")
     */
    public function edit(Request $request, ParticipantType $participantType): Response
    {
        $form = $this->createForm(ParticipantType1Type::class, $participantType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_participant_type_edit', ['id' => $participantType->getId()]);
        }

        return $this->render('back/participant_type/edit.html.twig', [
            'participant_type' => $participantType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="back_participant_type_delete", methods="DELETE")
     */
    public function delete(Request $request, ParticipantType $participantType): Response
    {
        if ($this->isCsrfTokenValid('delete'.$participantType->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($participantType);
            $em->flush();
            $this->addFlash(
                'success',
                'Suppression efféctué avec succès!'
            );
        }

        return $this->redirectToRoute('back_participant_type_index');
    }
}
