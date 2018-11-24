<?php

namespace App\Controller;

use App\Entity\Hotel;
use App\Entity\HotelPackage;
use App\Form\HotelPackageType;
use App\Repository\HotelPackageRepository;
use App\Services\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/hotel/package")
 */
class HotelPackageController extends Controller
{
    /**
     * @Route("/{hotel}", name="back_hotel_package_index", methods="GET")
     */
    public function index(HotelPackageRepository $hotelPackageRepository, Hotel $hotel): Response
    {
        return $this->render('back/hotel_package/index.html.twig', [
            'hotel_packages' => $hotelPackageRepository->findBy(['hotel' => $hotel]),
            'hotel' => $hotel
        ]);
    }

    /**
     * @Route("/{hotel}/new", name="back_hotel_package_new", methods="GET|POST")
     */
    public function new(Request $request, Hotel $hotel, FileUploader $fileUploader): Response
    {
        $hotelPackage = new HotelPackage();
        $form = $this->createForm(HotelPackageType::class, $hotelPackage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //upload new file
            $file = $hotelPackage->getPicture();
            $fileUploader->setTargetDirectory($this->getParameter('hotels_packages_directory'));
            $fileName = $fileUploader->upload($file);

            $hotelPackage->setPicture($fileName);
            //end upload new file

            $hotelPackage->setHotel($hotel);

            $em = $this->getDoctrine()->getManager();
            $em->persist($hotelPackage);
            $em->flush();
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_hotel_package_index', ['hotel' => $hotel->getId()]);
        }

        return $this->render('back/hotel_package/new.html.twig', [
            'hotel_package' => $hotelPackage,
            'form' => $form->createView(),
            'hotel' => $hotel
        ]);
    }

    /**
     * @Route("/{id}/show", name="back_hotel_package_show", methods="GET")
     */
    public function show(HotelPackage $hotelPackage): Response
    {
        return $this->render('back/hotel_package/show.html.twig', ['hotel_package' => $hotelPackage]);
    }

    /**
     * @Route("/{id}/edit", name="back_hotel_package_edit", methods="GET|POST")
     */
    public function edit(Request $request, HotelPackage $hotelPackage, FileUploader $fileUploader): Response
    {
        //upload file
        $fileUploader->setTargetDirectory($this->getParameter('hotels_packages_directory'));
        $oldFileName = $hotelPackage->getPicture();
        if(!empty($oldFileName)) {
            $fileUploader->setOldFilename($oldFileName);
            $fileName = $fileUploader->getTargetDirectory().$oldFileName;
            if(file_exists($fileName)){
                $hotelPackage->setPicture(new File($fileName));
            }else {
                $hotelPackage->setPicture(NULL);
            }
        }
        //end upload file


        $form = $this->createForm(HotelPackageType::class, $hotelPackage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //upload file
            $file = $hotelPackage->getPicture();
            $fileName = $fileUploader->upload($file);
            $hotelPackage->setPicture($fileName);
            //end upload file


            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_hotel_package_edit', ['id' => $hotelPackage->getId()]);
        }

        return $this->render('back/hotel_package/edit.html.twig', [
            'hotel_package' => $hotelPackage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="back_hotel_package_delete", methods="DELETE")
     */
    public function delete(Request $request, HotelPackage $hotelPackage): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hotelPackage->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($hotelPackage);
            $em->flush();
            $this->addFlash(
                'success',
                'Suppression efféctué avec succès!'
            );
        }

        return $this->redirectToRoute('back_hotel_package_index', ['hotel' => $hotelPackage->getHotel()]);
    }
}
