<?php

namespace App\Controller;

use App\Entity\Configuration;
use App\Form\ConfigurationType;
use App\Repository\ConfigurationRepository;
use App\Services\FileUploader;
use App\Utils\CodeGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/configuration")
 */
class ConfigurationController extends Controller
{
    /**
     * @Route("/", name="back_configuration_index", methods="GET")
     */
    public function index(ConfigurationRepository $configurationRepository): Response
    {
        return $this->render('back/configuration/index.html.twig', ['configurations' => $configurationRepository->findAll()]);
    }

    /**
     * @Route("/new", name="back_configuration_new", methods="GET|POST")
     */
    public function new(Request $request, FileUploader $fileUploader): Response
    {
        $configuration = new Configuration();
        $form = $this->createForm(ConfigurationType::class, $configuration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //upload new file
            $file = $configuration->getLogo();
            $fileUploader->setTargetDirectory($this->getParameter('configuration_directory'));
            $fileName = $fileUploader->upload($file);

            $configuration->setLogo($fileName);
            //end upload new file

            $em = $this->getDoctrine()->getManager();
            $em->persist($configuration);
            $em->flush();
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_configuration_index');
        }

        return $this->render('back/configuration/new.html.twig', [
            'configuration' => $configuration,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="back_configuration_show", methods="GET")
     */
    public function show(Configuration $configuration): Response
    {
        return $this->render('back/configuration/show.html.twig', ['configuration' => $configuration]);
    }

    /**
     * @Route("/{id}/edit", name="back_configuration_edit", methods="GET|POST")
     */
    public function edit(Request $request, Configuration $configuration, FileUploader $fileUploader): Response
    {
        //upload file
        $fileUploader->setTargetDirectory($this->getParameter('configuration_directory'));
        $oldFileName = $configuration->getLogo();
        if(!empty($oldFileName)) {
            $fileUploader->setOldFilename($oldFileName);

            $fileName = $fileUploader->getTargetDirectory().$oldFileName;

            $configuration->setLogo(new File($fileName));
        }
        //end upload file

        $form = $this->createForm(ConfigurationType::class, $configuration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //upload file
            $file = $configuration->getLogo();
            $fileName = $fileUploader->upload($file);
            $configuration->setLogo($fileName);
            //end upload file

            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_configuration_edit', ['id' => $configuration->getId()]);
        }

        return $this->render('back/configuration/edit.html.twig', [
            'configuration' => $configuration,
            'edit_form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="back_configuration_delete", methods="DELETE")
     */
    public function delete(Request $request, Configuration $configuration): Response
    {
        if ($this->isCsrfTokenValid('delete'.$configuration->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($configuration);
            $em->flush();
            $this->addFlash(
                'success',
                'Suppression efféctué avec succès!'
            );
        }

        return $this->redirectToRoute('back_configuration_index');
    }
}
