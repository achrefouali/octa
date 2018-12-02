<?php
/**
 * Created by PhpStorm.
 * User: acf
 * Date: 29/11/2018
 * Time: 23:29
 */

namespace App\Controller;

use App\Entity\Event;
use App\Entity\Reservation;
use App\Entity\ReservationEvent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Component\Serializer\Normalizer\DataUriNormalizer ; 
/**
 * @Route("/back/etat")
 */
class EtatController extends Controller
{
    /**
     * @Route("/paiement", name="back_etat_paimentType", methods="GET")
     */
    public function listEtatPaiementType(Request $request){
        $event = $this->getDoctrine()->getRepository(Reservation::class)->findBy(['state' => [1,2]]);

        $id = [];
        foreach ($event as $item) {
            $id[] = $item->getId();
        }

        $reservation = $this->getDoctrine()->getRepository(ReservationEvent::class)->findBy(['reservation' => $id]);

        $resultCarte = [];
        $resultVirement = [];
        $resultCheque = [];
        $resultBon = [];
        $resultLiquide = [];
        foreach ($reservation as $item_reservation) {
            $object = ['code' => (is_null($item_reservation->getCode())) ? '' : $item_reservation->getCode(),
                'pays' => $item_reservation->getReservation()->getParticipant()->getPays()->getName(),
                'firstname' => $item_reservation->getReservation()->getParticipant()->getFirstname(),
                'lastname' => $item_reservation->getReservation()->getParticipant()->getLastname(),
                'compagnie' => $item_reservation->getReservation()->getParticipant()->getSociete(),
                'apaye' => $item_reservation->getTotal(),
                'paye' => (is_null($item_reservation->getReceivedAmout())) ? 0 : $item_reservation->getReceivedAmout(),
                'currency' => (is_null($item_reservation->getCurrency())) ? '' : $item_reservation->getFormattedCurrency()];
            switch ($item_reservation->getPaiementType()) {

                case 0 :
                    $resultCarte[] = $object;
                    break;
                case 1 :
                    $resultVirement[] = $object;
                    break;
                case 2 :
                    $resultCheque[] = $object;
                    break;
                case 3 :
                    $resultBon[] = $object;
                    break;
                case 4 :
                    $resultLiquide[] = $object;
                    break;
            }
        }
        $result = ['carte' => $resultCarte,
            'virement' => $resultVirement,
            'cheque' => $resultCheque,
            'bon' => $resultBon,
            'liquide' => $resultLiquide];


        return $this->render('back/etat/index.html.twig', ['result' =>$result]);
    }
    /**
     * @Route("/arrived", name="back_etat_arrived", methods="GET")
     */
    public function listEtatArrivedByDate(Request $request){
        $event = $this->getDoctrine()->getRepository(Reservation::class)->findReservationOrder();

        $result=[];
        foreach($event as $event_item){
            $reservation = $this->getDoctrine()->getRepository(ReservationEvent::class)->findOneBy(['reservation' => $event_item->getId()]);
            if(!is_null($reservation)){
                $object = ['code' => (is_null($reservation->getCode())) ? '' : $reservation->getCode(),
                    'pays' => $reservation->getReservation()->getParticipant()->getPays()->getName(),
                    'firstname' => $reservation->getReservation()->getParticipant()->getFirstname(),
                    'lastname' => $reservation->getReservation()->getParticipant()->getLastname(),
                    'compagnie' => $reservation->getReservation()->getParticipant()->getSociete(),
                    'heure'=>(!is_null($reservation->getReservation()->getHeureArrival())? $reservation->getReservation()->getHeureArrival()->format('H:m:i'):'')
                ];
                $date=$event_item->getDateArrive();
                if(is_null($date)){
                    $result[0][]=$object;
                }else{
                    $result[$date->format('Y-m-d')][]=$object;
                }
            }

        }

        
        return $this->render('back/etat/indexArrived.html.twig', ['result' =>$result]);
        
        
    }


    /**
     * @Route("/depart", name="back_etat_depart", methods="GET")
     */
    public function listEtatDepartByDate(Request $request){

      
        $event = $this->getDoctrine()->getRepository(Reservation::class)->findReservationDepartOrder();

        $result=[];
        foreach($event as $event_item){
            $reservation = $this->getDoctrine()->getRepository(ReservationEvent::class)->findOneBy(['reservation' => $event_item->getId()]);
            if(!is_null($reservation)){
                $object = ['code' => (is_null($reservation->getCode())) ? '' : $reservation->getCode(),
                    'pays' => $reservation->getReservation()->getParticipant()->getPays()->getName(),
                    'firstname' => $reservation->getReservation()->getParticipant()->getFirstname(),
                    'lastname' => $reservation->getReservation()->getParticipant()->getLastname(),
                    'compagnie' => $reservation->getReservation()->getParticipant()->getSociete(),
                    'heure'=>(!is_null($reservation->getReservation()->getHeureDeparture())? $reservation->getReservation()->getHeureDeparture()->format('H:m:i'):'')
                ];
                $date=$event_item->getDateDepart();
                if(is_null($date)){
                    $result[0][]=$object;
                }else{
                    $result[$date->format('Y-m-d')][]=$object;
                }
            }

        }

       
        return $this->render('back/etat/indexDepart.html.twig', ['result' =>$result]);


    }



    /**
     * @Route("/pdf/listPaiement", name="back_etat_paimentType_pdf", methods="GET")
     */

    public function pdfListEtatPaiement(Request $request){

         $eventObject = $this->getDoctrine()
                      ->getRepository(Event::class)
                      ->findOneBy(['enabled' => true])
        ;
        $logo = $this->get('kernel')->getRootDir() . '/../public/uploads/events/'.$eventObject->getLogoFacture() ;
                $normalizer = new DataUriNormalizer();
                $avatar = $normalizer->normalize(new \SplFileObject($logo));


           $event = $this->getDoctrine()->getRepository(Reservation::class)->findBy(['state' => [1,2]]);

        $id = [];
        foreach ($event as $item) {
            $id[] = $item->getId();
        }

        $reservation = $this->getDoctrine()->getRepository(ReservationEvent::class)->findBy(['reservation' => $id]);

        $resultCarte = [];
        $resultVirement = [];
        $resultCheque = [];
        $resultBon = [];
        $resultLiquide = [];
        foreach ($reservation as $item_reservation) {
            $object = ['code' => (is_null($item_reservation->getCode())) ? '' : $item_reservation->getCode(),
                'pays' => $item_reservation->getReservation()->getParticipant()->getPays()->getName(),
                'firstname' => $item_reservation->getReservation()->getParticipant()->getFirstname(),
                'lastname' => $item_reservation->getReservation()->getParticipant()->getLastname(),
                'compagnie' => $item_reservation->getReservation()->getParticipant()->getSociete(),
                'apaye' => $item_reservation->getTotal(),
                'paye' => (is_null($item_reservation->getReceivedAmout())) ? 0 : $item_reservation->getReceivedAmout(),
                'currency' => (is_null($item_reservation->getCurrency())) ? '' : $item_reservation->getFormattedCurrency()];
            switch ($item_reservation->getPaiementType()) {

                case 0 :
                    $resultCarte[] = $object;
                    break;
                case 1 :
                    $resultVirement[] = $object;
                    break;
                case 2 :
                    $resultCheque[] = $object;
                    break;
                case 3 :
                    $resultBon[] = $object;
                    break;
                case 4 :
                    $resultLiquide[] = $object;
                    break;
            }
        }
        $result = ['carte' => $resultCarte,
            'virement' => $resultVirement,
            'cheque' => $resultCheque,
            'bon' => $resultBon,
            'liquide' => $resultLiquide];
         $pdfOptions = new Options(); 
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('back/etat/pdf/pdfPaiement.html.twig', [
            'result' => $result,
            'avatar'=>$avatar
        ]);
        
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $date = new \Datetime('now');
        
        $dompdf->stream('pdfPaiement_'.$date->format('Y-m-d H:i:s').'.pdf', [
            "Attachment" => true
        ]);
    }

     /**
     * @Route("/pdf/arrived", name="back_etat_pdf_arrived", methods="GET")
     */
    public function pdfEtatArrivedByDate(Request $request){

          $eventObject = $this->getDoctrine()
                      ->getRepository(Event::class)
                      ->findOneBy(['enabled' => true])
        ;
        $logo = $this->get('kernel')->getRootDir() . '/../public/uploads/events/'.$eventObject->getLogoFacture() ;
                $normalizer = new DataUriNormalizer();
                $avatar = $normalizer->normalize(new \SplFileObject($logo));
        $event = $this->getDoctrine()->getRepository(Reservation::class)->findReservationOrder();

        $result=[];
        foreach($event as $event_item){
            $reservation = $this->getDoctrine()->getRepository(ReservationEvent::class)->findOneBy(['reservation' => $event_item->getId()]);
            if(!is_null($reservation)){
                $object = ['code' => (is_null($reservation->getCode())) ? '' : $reservation->getCode(),
                    'pays' => $reservation->getReservation()->getParticipant()->getPays()->getName(),
                    'firstname' => $reservation->getReservation()->getParticipant()->getFirstname(),
                    'lastname' => $reservation->getReservation()->getParticipant()->getLastname(),
                    'compagnie' => $reservation->getReservation()->getParticipant()->getSociete(),
                    'heure'=>(!is_null($reservation->getReservation()->getHeureArrival())? $reservation->getReservation()->getHeureArrival()->format('H:m:i'):'')
                ];
                $date=$event_item->getDateArrive();
                if(is_null($date)){
                    $result[0][]=$object;
                }else{
                    $result[$date->format('Y-m-d')][]=$object;
                }
            }

        }

             $pdfOptions = new Options(); 
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('back/etat/pdf/pdfArrived.html.twig', [
            'result' => $result,
            'avatar'=>$avatar
        ]);
        
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $date = new \Datetime('now');
        
        $dompdf->stream('pdfArrived_'.$date->format('Y-m-d H:i:s').'.pdf', [
            "Attachment" => true
        ]);

        
        
        
        
    }



     /**
     * @Route("/pdf/depart", name="back_etat_pdf_depart", methods="GET")
     */
    public function pdfEtatDepartByDate(Request $request){

          $eventObject = $this->getDoctrine()
                      ->getRepository(Event::class)
                      ->findOneBy(['enabled' => true])
        ;
        $logo = $this->get('kernel')->getRootDir() . '/../public/uploads/events/'.$eventObject->getLogoFacture() ;
                $normalizer = new DataUriNormalizer();
                $avatar = $normalizer->normalize(new \SplFileObject($logo));
       $event = $this->getDoctrine()->getRepository(Reservation::class)->findReservationDepartOrder();

        $result=[];
        foreach($event as $event_item){
            $reservation = $this->getDoctrine()->getRepository(ReservationEvent::class)->findOneBy(['reservation' => $event_item->getId()]);
            if(!is_null($reservation)){
                $object = ['code' => (is_null($reservation->getCode())) ? '' : $reservation->getCode(),
                    'pays' => $reservation->getReservation()->getParticipant()->getPays()->getName(),
                    'firstname' => $reservation->getReservation()->getParticipant()->getFirstname(),
                    'lastname' => $reservation->getReservation()->getParticipant()->getLastname(),
                    'compagnie' => $reservation->getReservation()->getParticipant()->getSociete(),
                    'heure'=>(!is_null($reservation->getReservation()->getHeureDeparture())? $reservation->getReservation()->getHeureDeparture()->format('H:m:i'):'')
                ];
                $date=$event_item->getDateDepart();
                if(is_null($date)){
                    $result[0][]=$object;
                }else{
                    $result[$date->format('Y-m-d')][]=$object;
                }
            }

        }

             $pdfOptions = new Options(); 
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('back/etat/pdf/pdfDepart.html.twig', [
            'result' => $result,
            'avatar'=>$avatar
        ]);
        
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $date = new \Datetime('now');
        
        $dompdf->stream('pdfDepart_'.$date->format('Y-m-d H:i:s').'.pdf', [
            "Attachment" => true
        ]);

        
        
        
        
    }

}