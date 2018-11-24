<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Participant;
use App\Entity\Notification;
use App\Form\MassMailingType;

class MassMailingController extends Controller
{
    /**
     * @Route("/back/mass/mailing", name="back_mass_mailing")
     */
    public function index(Request $request): Response
    {
        $form = $this->createForm(MassMailingType::class, null);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $notification = $form['notification']->getData();
            $participants = $form['participants']->getData();



            $baseNotification = new \App\Event\BaseNotification($notification, $participants->toArray());
            $baseNotification
//                ->addData($form)

            ;

            $notificationEvent = new \App\Event\NotificationEvent();
            $notificationEvent->addBaseNotification($baseNotification);
            $this->get('event_dispatcher')->dispatch(
                'application.notification',
                $notificationEvent
            )
            ;

            $this->addFlash(
                'success',
                'Emails envoyées avec succès!'
            );
        }

        return $this->render('back/mass_mailing/index.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'MassMailingController',
        ]);
    }
}
