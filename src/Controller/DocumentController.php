<?php

namespace App\Controller;

use App\Entity\Document;
use App\Form\DocumentType;
use App\Repository\DocumentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/document")
 */
class DocumentController extends Controller
{
    /**
     * @Route("/", name="back_document_index", methods="GET")
     */
    public function index(DocumentRepository $documentRepository): Response
    {
        return $this->render('back/document/index.html.twig', ['documents' => $documentRepository->findAll()]);
    }

    /**
     * @Route("/new", name="back_document_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $document = new Document();
        $form = $this->createForm(DocumentType::class, $document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($document);
            $em->flush();
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_document_index');
        }

        return $this->render('back/document/new.html.twig', [
            'document' => $document,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/show", name="back_document_show", methods="GET")
     */
    public function show(Document $document): Response
    {
        return $this->render('back/document/show.html.twig', ['document' => $document]);
    }

    /**
     * @Route("/{id}/edit", name="back_document_edit", methods="GET|POST")
     */
    public function edit(Request $request, Document $document): Response
    {
        $form = $this->createForm(DocumentType::class, $document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_document_edit', ['id' => $document->getId()]);
        }

        return $this->render('back/document/edit.html.twig', [
            'document' => $document,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="back_document_delete", methods="DELETE")
     */
    public function delete(Request $request, Document $document): Response
    {
        if ($this->isCsrfTokenValid('delete'.$document->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($document);
            $em->flush();
            $this->addFlash(
                'success',
                'Suppression efféctué avec succès!'
            );
        }

        return $this->redirectToRoute('back_document_index');
    }
}
