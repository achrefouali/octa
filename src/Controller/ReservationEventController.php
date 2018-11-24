<?php

namespace App\Controller;

use App\Entity\Accompanying;
use App\Entity\Reservation;
use App\Entity\ReservationEvent;
use App\Entity\Tarif;
use App\Form\ReservationEventType;
use App\Repository\ReservationEventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/reservation/event")
 */
class ReservationEventController extends Controller
{
    /**
     * @Route("/", name="back_reservation_event_index", methods="GET")
     */
    public function index(ReservationEventRepository $reservationEventRepository): Response
    {
        return $this->render('back/reservation_event/index.html.twig', [
            'reservation_events' => $reservationEventRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{reservation}/new", name="back_reservation_event_new", methods="GET|POST")
     */
    public function new(Request $request, Reservation $reservation): Response
    {
        $reservationEvent = new ReservationEvent();

        $paymentMethods = $this->getParameter('paymentMethod');
        $form = $this->createForm(ReservationEventType::class, $reservationEvent, [
            'paymentMethods' => $paymentMethods
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $reservationEvent->setReservation($reservation);

            $em->persist($reservationEvent);
            $em->flush();
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_reservation_event_index', ['reservation' => $reservation->getId()]);
        }

        return $this->render('back/reservation_event/new.html.twig', [
            'reservation_event' => $reservationEvent,
            'form' => $form->createView(),
            'reservation' => $reservation
        ]);
    }

    /**
     * @Route("/{id}/show", name="back_reservation_event_show", methods="GET")
     */
    public function show(ReservationEvent $reservationEvent): Response
    {
        return $this->render('back/reservation_event/show.html.twig', ['reservation_event' => $reservationEvent]);
    }

    /**
     * @Route("/{id}/edit", name="back_reservation_event_edit", methods="GET|POST")
     */
    public function edit(Request $request, ReservationEvent $reservationEvent ,\Swift_Mailer $mailer): Response
    {
        $paymentMethods = $this->getParameter('paymentMethod');
        $participant = $reservationEvent->getReservation()->getParticipant();
        $stateFormatted = $reservationEvent->getReservation()->getFormattedState();
        $event=    $reservationEvent->getEvent();
        $resevation=    $reservationEvent->getReservation();
        $state = $reservationEvent->getReservation()->getState();
        $acco=$this->getDoctrine()->getRepository(Accompanying::class)->findBy(['reservation'=>$reservationEvent->getReservation()->getId()]);
        $resultAcco=[];

        if(!empty($acco)){
            foreach($acco as $item){
                $resultAcco[]=['lastname'=>$item->getLastname(),
                               'firstname'=>$item->getFirtname(),
                                'type'=>$item->getFormattedType()];
            }

         }
      
        $form = $this->createForm(ReservationEventType::class, $reservationEvent, [
            'paymentMethods' => $paymentMethods,
            'participant'=>$participant,
            'state'=>$stateFormatted,
            'event'=>$event,
            'resevation'=>$resevation,
        ]);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $contacts=[];
            if($request->request->has('subsribeConfirmedWaiting')){
                $reservationEvent->getReservation()->setState(2);
                    $message = (new \Swift_Message("Confirmation d'inscription Conférence"))
                        ->setFrom('no-reply@fanaf2019.org')
                        ->setTo($participant->getEmail())
                        ->setBody(
                            $this->renderView(
                                'back/reservation_event/mail/mail.html.twig',
                                [
                                    'data'     => $event,

                                ]
                            ),
                            'text/html'
                        )
                    ;

                    $mailer->send($message);

            }
            
            if($request->request->has('rejected')){
                $reservationEvent->getReservation()->setState(4);
            }
            if($request->request->has('subsribeConfirmedPayed')){
                $reservationEvent->getReservation()->setState(1);
                $eventId=$reservationEvent->getEvent()->getId();
                $tarif=$reservationEvent->getTotal();
                $nbAcco = 0 ;

                $tarifAccPrice=0 ;
                $participantEffectif=$reservationEvent->getReservation()->getNbAccompanying();
                if(!is_null($participantEffectif)){
                    $nbAcco = $participantEffectif ;
                }
                $tarifAcco=$this->getDoctrine()->getRepository(Tarif::class)->findOneBy(['event'=>$eventId,'prix'=>$tarif]);
                if(!empty($tarifAcco)){
                    $tarifAccPrice = $tarifAcco->getPrixAccompagnant();
                }



                $html2   = $this->renderView(
                            'back/reservation_event/pdf/pdf.html.twig',
                            [
                                'base_dir' => $this->get('kernel')->getRootDir() . '/../public/',
                                'event'=>$reservationEvent->getEvent(),
                                'tarif'         => $tarif,
                                'tarifAcco' => $tarifAccPrice,
                                'nbAcco'          => $nbAcco,

                            ]
                        );

                $params = ['lowquality' => false, 'encoding'   => 'utf-8' ];

                $pdf = $this->get('knp_snappy.pdf')->getOutputFromHtml($html2, $params);
                
                $content_pdf = new \Swift_Attachment(
                    $pdf,
                    'recu.pdf',
                    'application/pdf'
                );
                $message = (new \Swift_Message("Récu paiement"))
                    ->setFrom('no-reply@fanaf2019.org')
                    ->setTo($participant->getEmail())
                    ->setBody(
                        $this->renderView(
                            'back/reservation_event/mail/mailPaiement.html.twig',
                            [
                                'data'     => $event,

                            ]
                        ),
                        'text/html'
                    )
                    ->attach($content_pdf)
                ;

                $mailer->send($message);

            }
            if($request->request->has('offred')){
                $reservationEvent->getReservation()->setState(8);
            }

            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_reservation_event_edit', ['id' => $reservationEvent->getId()]);
        }

        return $this->render('back/reservation_event/edit.html.twig', [
            'reservation_event' => $reservationEvent,
            'form' => $form->createView(),
            'resultAcco' => $resultAcco,
            'state'=>$state
        ]);
    }

    /**
     * @Route("/{id}/delete", name="back_reservation_event_delete", methods="DELETE")
     */
    public function delete(Request $request, ReservationEvent $reservationEvent): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservationEvent->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($reservationEvent);
            $em->flush();
            $this->addFlash(
                'success',
                'Suppression efféctué avec succès!'
            );
        }

        return $this->redirectToRoute('back_reservation_event_index', ['reservation' => $reservationEvent->getReservation()->getId()]);
    }
    public function getMailerService(){
        return ($this->get('application.mailer.reservation'));
    }
    
}
