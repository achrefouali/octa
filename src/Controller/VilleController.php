<?php

namespace App\Controller;

use App\Entity\Pays;
use App\Entity\Ville;
use App\Form\VilleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/ville")
 */
class VilleController extends Controller
{
    /**
     * @Route("/{pays}", name="back_ville_index", methods="GET")
     */
    public function index(Pays $pays): Response
    {
        $villes = $this->getDoctrine()
            ->getRepository(Ville::class)
            ->findBy(['pays' => $pays->getId()]);

        return $this->render('back/ville/index.html.twig', [
            'pays' => $pays,
            'villes' => $villes,
        ]);
    }

    /**
     * @Route("/{pays}/new", name="back_ville_new", methods="GET|POST")
     */
    public function new(Request $request, Pays $pays): Response
    {
        $ville = new Ville();
        $form = $this->createForm(VilleType::class, $ville);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ville);
            $em->flush();
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_ville_index');
        }

        return $this->render('back/ville/new.html.twig', [
            'pays' => $pays,
            'ville' => $ville,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/show", name="back_ville_show", methods="GET")
     */
    public function show(Ville $ville): Response
    {
        return $this->render('back/ville/show.html.twig', ['ville' => $ville]);
    }

    /**
     * @Route("/{id}/edit", name="back_ville_edit", methods="GET|POST")
     */
    public function edit(Request $request, Ville $ville): Response
    {
        $form = $this->createForm(VilleType::class, $ville);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_ville_edit', ['id' => $ville->getId()]);
        }

        return $this->render('back/ville/edit.html.twig', [
            'ville' => $ville,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="back_ville_delete", methods="DELETE")
     */
    public function delete(Request $request, Ville $ville): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ville->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ville);
            $em->flush();
            $this->addFlash(
                'success',
                'Suppression efféctué avec succès!'
            );
        }

        return $this->redirectToRoute('back_ville_index');
    }
}
