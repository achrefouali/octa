<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventType;
use App\Repository\EventRepository;
use App\Services\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/event")
 */
class EventController extends Controller
{
    /**
     * @Route("/", name="back_event_index", methods="GET")
     */
    public function index(EventRepository $eventRepository): Response
    {
        return $this->render('back/event/index.html.twig', ['events' => $eventRepository->findAll()]);
    }

    /**
     * @Route("/new", name="back_event_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $documents = $event->getDocuments();
            foreach($documents as $document){
                $documentUploader = new FileUploader();
                $documentUploader->setTargetDirectory($this->getParameter('documents_directory'));
                $documentName = $documentUploader->upload($document->getFile());

                $document->setFile($documentName);

            }



            //upload new logo
            $logoUploader = new FileUploader();
            $logo = $event->getLogo();
            $logoUploader->setTargetDirectory($this->getParameter('events_directory'));
            $logoName = $logoUploader->upload($logo);

            $event->setLogo($logoName);
            //end upload new file

            //upload new file
            $logoFactureUploader = new FileUploader();
            $logoFacture = $event->getLogoFacture();
            $logoFactureUploader->setTargetDirectory($this->getParameter('events_directory'));
            $logoFactureName = $logoFactureUploader->upload($logoFacture);

            $event->setLogoFacture($logoFactureName);
            //end upload new file

            //Programme Upload
            if(!is_null($event->getProgramFile())){
                $programeFileUploader = new FileUploader();
                $programme = $event->getProgramFile();
                $programeFileUploader->setTargetDirectory($this->getParameter('events_directory'));
                $programmeName = $programeFileUploader->upload($programme);

                $event->setProgramFile($programmeName);
                //End Programme Upload
            }

            if(!is_null($event->getBrochureFile())){
                $brochureFileUploader = new FileUploader();
                $brochure = $event->getBrochureFile();
                $brochureFileUploader->setTargetDirectory($this->getParameter('events_directory'));
                $brochureName = $brochureFileUploader->upload($brochure);

                $event->setBrochureFile($brochureName);
                //End Programme Upload
            }


            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_event_index');
        }

        return $this->render('back/event/new.html.twig', [
            'event' => $event,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="back_event_show", methods="GET")
     */
    public function show(Event $event): Response
    {
        return $this->render('back/event/show.html.twig', ['event' => $event]);
    }

    /**
     * @Route("/{id}/edit", name="back_event_edit", methods="GET|POST")
     */
    public function edit(Request $request, Event $event): Response
    {

        $documentUploader = new FileUploader();
        //check logo
        $logoUploader = new FileUploader();
        $logoUploader->setTargetDirectory($this->getParameter('events_directory'));
        $oldLogo = $event->getLogo();
        if(!empty($oldLogo)) {
            $logoUploader->setOldFilename($oldLogo);
            $logoName = $logoUploader->getTargetDirectory().$oldLogo;

            if(file_exists($logoName)){
                $event->setLogo(new File($logoName));
            }else {
                $event->setLogo(NULL);
            }
        }
        //end check logo

        //check logo facture
        $logoFactureUploader = new FileUploader();
        $logoFactureUploader->setTargetDirectory($this->getParameter('events_directory'));
        $oldLogoFacture = $event->getLogoFacture();
        if(!empty($oldLogoFacture)) {
            $logoFactureUploader->setOldFilename($oldLogoFacture);
            $logoFactureName = $logoFactureUploader->getTargetDirectory().$oldLogoFacture;

            if(file_exists($logoFactureName)){
                $event->setLogoFacture(new File($logoFactureName));
            }else {
                $event->setLogoFacture(NULL);
            }
        }
        //end upload logo Facture

        //check Programme File
        if(!is_null($event->getProgramFile())) {
            $programmeFileUploader = new FileUploader();
            $programmeFileUploader->setTargetDirectory($this->getParameter('events_directory'));
            $oldProgrammeFile = $event->getProgramFile();
            if (!empty($oldProgrammeFile)) {
                $programmeFileUploader->setOldFilename($oldProgrammeFile);
                $programmeFileName = $programmeFileUploader->getTargetDirectory() . $oldProgrammeFile;

                if (file_exists($programmeFileName)) {
                    $event->setProgramFile(new File($programmeFileName));
                } else {
                    $event->setProgramFile(NULL);
                }
            }
        }
        //end upload  Programme File
        
        //check Brochure File
        if(!is_null($event->getBrochureFile())) {
            $brochureFileUploader = new FileUploader();
            $brochureFileUploader->setTargetDirectory($this->getParameter('events_directory'));
            $oldBrochreFile = $event->getBrochureFile();
            if (!empty($oldBrochreFile)) {
                $brochureFileUploader->setOldFilename($oldBrochreFile);
                $brochureFileName = $brochureFileUploader->getTargetDirectory() . $oldBrochreFile;

                if (file_exists($brochureFileName)) {
                    $event->setBrochureFile(new File($brochureFileName));
                } else {
                    $event->setBrochureFile(NULL);
                }
            }
        }
        //end upload  Programme File

        //upload file
        $documentUploader->setTargetDirectory($this->getParameter('documents_directory'));
        $documents = $event->getDocuments();
        foreach($documents as $document){
            if(!empty($document->getFile())) {
                $documentUploader->setOldFilename($document->getFile());
                $documentNameFacture = $documentUploader->getTargetDirectory().$document->getFile();

                if(file_exists($documentNameFacture)){
                    $document->setFile(new File($documentNameFacture));
                }else {
                    $document->setFile(NULL);
                }
            }
        }

        //end upload file

        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            
           $files =$request->files->get('event');
            $documents = $event->getDocuments();
            foreach($documents as $document){
                $documentUploader = new FileUploader();
                $documentUploader->setTargetDirectory($this->getParameter('documents_directory'));
                $documentName = $documentUploader->upload($document->getFile());

                $document->setFile($documentName);

            }
            if(!is_null($files['logo'])){
                //upload new logo
                $logoUploader = new FileUploader();
                $logo = $event->getLogo();
                $logoUploader->setTargetDirectory($this->getParameter('events_directory'));
                $logoName = $logoUploader->upload($logo);

                $event->setLogo($logoName);
                //end upload new file
            }

            if(!is_null($files['logoFacture'])) {
                //upload new file
                $logoFactureUploader = new FileUploader();
                $logoFacture = $event->getLogoFacture();
                $logoFactureUploader->setTargetDirectory($this->getParameter('events_directory'));
                $logoFactureName = $logoFactureUploader->upload($logoFacture);

                $event->setLogoFacture($logoFactureName);
                //end upload new file
            }

            if(!is_null($files['programFile'])) {
                //Programme Upload

                    $programeFileUploader = new FileUploader();
                    $programme = $event->getProgramFile();
                    $programeFileUploader->setTargetDirectory($this->getParameter('events_directory'));
                    $programmeName = $programeFileUploader->upload($programme);

                    $event->setProgramFile($programmeName);
                    //End Programme Upload

            }
            if(!is_null($files['brochureFile'])) {
                if (!is_null($event->getBrochureFile())) {
                    $brochureFileUploader = new FileUploader();
                    $brochure = $event->getBrochureFile();
                    $brochureFileUploader->setTargetDirectory($this->getParameter('events_directory'));
                    $brochureName = $brochureFileUploader->upload($brochure);

                    $event->setBrochureFile($brochureName);
                    //End Programme Upload
                }
            }

            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_event_edit', ['id' => $event->getId()]);
        }

        return $this->render('back/event/edit.html.twig', [
            'event' => $event,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="back_event_delete", methods="DELETE")
     */
    public function delete(Request $request, Event $event): Response
    {
        if ($this->isCsrfTokenValid('delete'.$event->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($event);
            $em->flush();
            $this->addFlash(
                'success',
                'Suppression efféctué avec succès!'
            );
        }

        return $this->redirectToRoute('back_event_index');
    }
}
