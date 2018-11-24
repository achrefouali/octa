<?php

namespace App\Controller;

use App\Entity\Hotel;
use App\Entity\HotelImage;
use App\Form\HotelImageType;

use App\Services\FileUploader;
use App\Utils\CodeGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/hotel/image")
 */
class HotelImageController extends Controller
{
    /**
     * @Route("/{hotel}", name="back_hotel_image_index", methods="GET")
     */
    public function index( Hotel $hotel): Response
    {
        $em = $this->getDoctrine()->getManager();
        return $this->render('back/hotel_image/index.html.twig', [
            'hotel' => $hotel,
            'hotel_images' => $em->getRepository('App:HotelImage')->findBy(['hotel' => $hotel])
        ]);
    }

    /**
     * @Route("/{hotel}/new", name="back_hotel_image_new", methods="GET|POST")
     */
    public function new(Request $request, Hotel $hotel, FileUploader $fileUploader): Response
    {
        $hotelImage = new HotelImage();
        $form = $this->createForm(HotelImageType::class, $hotelImage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            //upload new file
            $file = $hotelImage->getPicture();
            $fileUploader->setTargetDirectory($this->getParameter('hotels_directory'));
            $fileName = $fileUploader->upload($file);

            $hotelImage->setPicture($fileName);
            //end upload new file

            $hotelImage->setHotel($hotel);




            $em = $this->getDoctrine()->getManager();
            $em->persist($hotelImage);
            $em->flush();
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_hotel_image_index', ['hotel' => $hotel->getId()]);
        }

        return $this->render('back/hotel_image/new.html.twig', [
            'hotel' => $hotel,
            'hotel_image' => $hotelImage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/show", name="back_hotel_image_show", methods="GET")
     */
    public function show(HotelImage $hotelImage): Response
    {
        return $this->render('back/hotel_image/show.html.twig', [
            'hotel_image' => $hotelImage
        ]);
    }

    /**
     * @Route("/{id}/edit", name="back_hotel_image_edit", methods="GET|POST")
     */
    public function edit(Request $request, HotelImage $hotelImage, FileUploader $fileUploader): Response
    {

        //upload file
        $fileUploader->setTargetDirectory($this->getParameter('hotels_directory'));
        $oldFileName = $hotelImage->getPicture();
        if(!empty($oldFileName)) {
            $fileUploader->setOldFilename($oldFileName);

            $fileName = $fileUploader->getTargetDirectory().$oldFileName;

            $hotelImage->setPicture(new File($fileName));
        }
        //end upload file



        $form = $this->createForm(HotelImageType::class, $hotelImage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {



            //upload file
            $file = $hotelImage->getPicture();
            $fileName = $fileUploader->upload($file);
            $hotelImage->setPicture($fileName);
            //end upload file


            $this->getDoctrine()->getManager()->flush();
            if(!empty($oldPicture)){
                unlink($this->getParameter('hotels_directory').'/'.$oldPicture);
            }
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_hotel_image_edit', ['id' => $hotelImage->getId()]);
        }

        return $this->render('back/hotel_image/edit.html.twig', [
            'hotel_image' => $hotelImage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="back_hotel_image_delete", methods="DELETE")
     */
    public function delete(Request $request, HotelImage $hotelImage): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hotelImage->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($hotelImage);
            $em->flush();
            $this->addFlash(
                'success',
                'Suppression efféctué avec succès!'
            );
        }

        return $this->redirectToRoute('back_hotel_image_index', ['hotel' => $hotelImage->getHotel()->getId()]);
    }
}
