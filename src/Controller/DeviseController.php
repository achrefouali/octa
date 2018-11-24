<?php

namespace App\Controller;

use App\Entity\Devise;
use App\Form\DeviseType;
use App\Repository\DeviseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/devise")
 */
class DeviseController extends Controller
{
    /**
     * @Route("/", name="back_devise_index", methods="GET")
     */
    public function index(DeviseRepository $deviseRepository): Response
    {
        return $this->render('back/devise/index.html.twig', ['devises' => $deviseRepository->findAll()]);
    }

    /**
     * @Route("/new", name="back_devise_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $devise = new Devise();
        $form = $this->createForm(DeviseType::class, $devise);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($devise);
            $em->flush();
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_devise_index');
        }

        return $this->render('back/devise/new.html.twig', [
            'devise' => $devise,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/show", name="back_devise_show", methods="GET")
     */
    public function show(Devise $devise): Response
    {
        return $this->render('back/devise/show.html.twig', ['devise' => $devise]);
    }

    /**
     * @Route("/{id}/edit", name="back_devise_edit", methods="GET|POST")
     */
    public function edit(Request $request, Devise $devise): Response
    {
        $form = $this->createForm(DeviseType::class, $devise);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_devise_edit', ['id' => $devise->getId()]);
        }

        return $this->render('back/devise/edit.html.twig', [
            'devise' => $devise,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="devise_delete", methods="DELETE")
     */
    public function delete(Request $request, Devise $devise): Response
    {
        if ($this->isCsrfTokenValid('delete'.$devise->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($devise);
            $em->flush();
            $this->addFlash(
                'success',
                'Suppression efféctué avec succès!'
            );
        }

        return $this->redirectToRoute('back_devise_index');
    }
}
