<?php

namespace App\Controller;

use App\Entity\Pattern;
use App\Form\PatternType;
use App\Repository\PatternRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/pattern")
 */
class PatternController extends Controller
{
    /**
     * @Route("/", name="back_pattern_index", methods="GET")
     */
    public function index(PatternRepository $patternRepository): Response
    {
        return $this->render('back/pattern/index.html.twig', ['patterns' => $patternRepository->findAll()]);
    }

    /**
     * @Route("/new", name="back_pattern_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $pattern = new Pattern();
        $form = $this->createForm(PatternType::class, $pattern);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pattern);
            $em->flush();
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_pattern_index');
        }

        return $this->render('back/pattern/new.html.twig', [
            'pattern' => $pattern,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="back_pattern_show", methods="GET")
     */
    public function show(Pattern $pattern): Response
    {
        return $this->render('back/pattern/show.html.twig', ['pattern' => $pattern]);
    }

    /**
     * @Route("/{id}/edit", name="back_pattern_edit", methods="GET|POST")
     */
    public function edit(Request $request, Pattern $pattern): Response
    {
        $form = $this->createForm(PatternType::class, $pattern);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_pattern_edit', ['id' => $pattern->getId()]);
        }

        return $this->render('back/pattern/edit.html.twig', [
            'pattern' => $pattern,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="back_pattern_delete", methods="DELETE")
     */
    public function delete(Request $request, Pattern $pattern): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pattern->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pattern);
            $em->flush();
            $this->addFlash(
                'success',
                'Suppression efféctué avec succès!'
            );
        }

        return $this->redirectToRoute('back_pattern_index');
    }
}
