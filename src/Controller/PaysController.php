<?php

namespace App\Controller;

use App\Entity\Pays;
use App\Form\PaysType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/pays")
 */
class PaysController extends Controller
{
    /**
     * @Route("/", name="back_pays_index", methods="GET")
     */
    public function index(): Response
    {
        $pays = $this->getDoctrine()
            ->getRepository(Pays::class)
            ->findAll();

        return $this->render('back/pays/index.html.twig', ['pays' => $pays]);
    }

    /**
     * @Route("/new", name="back_pays_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $pays = new Pays();
        $form = $this->createForm(PaysType::class, $pays);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pays);
            $em->flush();
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_pays_index');
        }

        return $this->render('back/pays/new.html.twig', [
            'pays' => $pays,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="back_pays_show", methods="GET")
     */
    public function show(Pays $pay): Response
    {
        return $this->render('back/pays/show.html.twig', ['pays' => $pays]);
    }

    /**
     * @Route("/{id}/edit", name="back_pays_edit", methods="GET|POST")
     */
    public function edit(Request $request, Pays $pays): Response
    {
        $form = $this->createForm(PaysType::class, $pays);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_pays_edit', ['id' => $pays->getId()]);
        }

        return $this->render('back/pays/edit.html.twig', [
            'pays' => $pays,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="back_pays_delete", methods="DELETE")
     */
    public function delete(Request $request, Pays $pays): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pays->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pays);
            $em->flush();
            $this->addFlash(
                'success',
                'Suppression efféctué avec succès!'
            );
        }

        return $this->redirectToRoute('back_pays_index');
    }
}
