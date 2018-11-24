<?php

namespace App\Controller;

use App\Entity\Sponsor;
use App\Form\SponsorType;
use App\Repository\SponsorRepository;
use App\Services\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/sponsor")
 */
class SponsorController extends Controller
{
    /**
     * @Route("/", name="back_sponsor_index", methods="GET")
     */
    public function index(SponsorRepository $sponsorRepository): Response
    {
        return $this->render('back/sponsor/index.html.twig', ['sponsors' => $sponsorRepository->findAll()]);
    }

    /**
     * @Route("/new", name="back_sponsor_new", methods="GET|POST")
     */
    public function new(Request $request, FileUploader $fileUploader): Response
    {
        $sponsor = new Sponsor();
        $form = $this->createForm(SponsorType::class, $sponsor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //upload new file
            $file = $sponsor->getLogo();
            $fileUploader->setTargetDirectory($this->getParameter('sponsors_directory'));
            $fileName = $fileUploader->upload($file);

            $sponsor->setLogo($fileName);
            //end upload new file


            $em = $this->getDoctrine()->getManager();
            $em->persist($sponsor);
            $em->flush();
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_sponsor_index');
        }

        return $this->render('back/sponsor/new.html.twig', [
            'sponsor' => $sponsor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="back_sponsor_show", methods="GET")
     */
    public function show(Sponsor $sponsor): Response
    {
        return $this->render('back/sponsor/show.html.twig', ['sponsor' => $sponsor]);
    }

    /**
     * @Route("/{id}/edit", name="back_sponsor_edit", methods="GET|POST")
     */
    public function edit(Request $request, Sponsor $sponsor, FileUploader $fileUploader): Response
    {

        //upload file
        $fileUploader->setTargetDirectory($this->getParameter('sponsors_directory'));
        $oldFileName = $sponsor->getLogo();
        if(!empty($oldFileName)) {
            $fileUploader->setOldFilename($oldFileName);
            $fileName = $fileUploader->getTargetDirectory().$oldFileName;
            $sponsor->setLogo(new File($fileName));
        }
        //end upload file


        $form = $this->createForm(SponsorType::class, $sponsor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //upload file
            $file = $sponsor->getLogo();
            $fileName = $fileUploader->upload($file);
            $sponsor->setLogo($fileName);
            //end upload file

            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_sponsor_edit', ['id' => $sponsor->getId()]);
        }

        return $this->render('back/sponsor/edit.html.twig', [
            'sponsor' => $sponsor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="back_sponsor_delete", methods="DELETE")
     */
    public function delete(Request $request, Sponsor $sponsor): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sponsor->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sponsor);
            $em->flush();
            $this->addFlash(
                'success',
                'Suppression efféctué avec succès!'
            );
        }

        return $this->redirectToRoute('back_sponsor_index');
    }
}
