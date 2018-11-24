<?php

namespace App\Controller;

use App\Entity\Participant;
use App\Form\ParticipantType;
use App\Repository\ParticipantRepository;
use App\Services\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/participant")
 */
class ParticipantController extends Controller
{
    /**
     * @Route("/", name="back_participant_index", methods="GET")
     */
    public function index(ParticipantRepository $participantRepository): Response
    {
        return $this->render('back/participant/index.html.twig', ['participants' => $participantRepository->findAll()]);
    }

    /**
     * @Route("/new", name="back_participant_new", methods="GET|POST")
     */
    public function new(Request $request, FileUploader $fileUploader): Response
    {
        $participant = new Participant();
        $form = $this->createForm(ParticipantType::class, $participant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $password = $form['password']->getData();

            $participant->setSalt(md5(uniqid()));

            // the 'security.password_encoder' service requires Symfony 2.6 or higher
            $encoder = $this->container->get('security.password_encoder');
            $password = $encoder->encodePassword($participant, $password);


            $participant->setPassword($password);

            //upload new file
            $file = $participant->getPicture();
            $fileUploader->setTargetDirectory($this->getParameter('intervenants_directory'));
            $fileName = $fileUploader->upload($file);

            $participant->setPicture($fileName);
            //end upload new file


            $em = $this->getDoctrine()->getManager();
            $em->persist($participant);
            $em->flush();
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_participant_index');
        }

        return $this->render('back/participant/new.html.twig', [
            'participant' => $participant,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="back_participant_show", methods="GET")
     */
    public function show(Participant $participant): Response
    {
        return $this->render('back/participant/show.html.twig', ['participant' => $participant]);
    }

    /**
     * @Route("/{id}/edit", name="back_participant_edit", methods="GET|POST")
     */
    public function edit(Request $request, Participant $participant, FileUploader $fileUploader): Response
    {
        //upload file
        $fileUploader->setTargetDirectory($this->getParameter('intervenants_directory'));
        $oldFileName = $participant->getPicture();
        if(!empty($oldFileName)){
            $fileUploader->setOldFilename($oldFileName);

            $fileName = $fileUploader->getTargetDirectory(). $oldFileName;
            $participant->setPicture(new File($fileName));
        }
        //end upload file

        $form = $this->createForm(ParticipantType::class, $participant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $password = $form['password']->getData();

            $participant->setSalt(md5(uniqid()));

            // the 'security.password_encoder' service requires Symfony 2.6 or higher
            $encoder = $this->container->get('security.password_encoder');
            $password = $encoder->encodePassword($participant, $password);


            $participant->setPassword($password);


            //upload file
            $file = $participant->getPicture();
            $fileName = $fileUploader->upload($file);
            $participant->setPicture($fileName);
            //end upload file

            $this->getDoctrine()->getManager()->persist($participant);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_participant_edit', ['id' => $participant->getId()]);
        }

        return $this->render('back/participant/edit.html.twig', [
            'participant' => $participant,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="back_participant_delete", methods="DELETE")
     */
    public function delete(Request $request, Participant $participant): Response
    {
        if ($this->isCsrfTokenValid('delete'.$participant->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($participant);
            $em->flush();
            $this->addFlash(
                'success',
                'Suppression efféctué avec succès!'
            );
        }

        return $this->redirectToRoute('back_participant_index');
    }
}
