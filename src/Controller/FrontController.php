<?php

namespace App\Controller;


use App\Entity\Accompanying;
use App\Entity\Configuration;
use App\Entity\Devise;
use App\Entity\Event;
use App\Entity\Hotel;
use App\Entity\HotelPackage;
use App\Entity\HotelReservationPackage;
use App\Entity\Journee;
use App\Entity\Menu;
use App\Entity\Organization;
use App\Entity\Page;
use App\Entity\Participant;
use App\Entity\ParticipantType;
use App\Entity\Pays;
use App\Entity\Reservation;
use App\Entity\ReservationSupplements;
use App\Entity\ReservationHotel;
use App\Entity\ReservationEvent;
use App\Entity\Role;
use App\Entity\SponsorType;
use App\Entity\Supplement;
use App\Entity\Tarif;
use App\Form\Front\ProfileType;
use App\Model\Registration;
use App\Utils\CodeGenerator;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Serializer\Normalizer\DataUriNormalizer;

/**
 * Class FrontController
 *
 * @package App\Controller
 *
 * @Route("/{_locale}", requirements={"_locale"= "fr|en"})
 */
class FrontController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function home(Request $request)
    {
        $session = $request->getSession();

        $currency = $request->get('_currency');

        $devise_criterias = ['main' => true];

        if(!empty($currency)){
            $devise_criterias = ['code' => $currency];
        }
        $devise = $this->getDoctrine()
                              ->getRepository(Devise::class)
                              ->findOneBy($devise_criterias)
        ;

        $session->set('currency', strtolower($devise->getCode()));
        if(empty($devise)){
            throw new \Exception('You have to define at least one main "Devise"');
        }


        $configuration = $this->getDoctrine()
                              ->getRepository(Configuration::class)
                              ->findOneBy(['enabled' => true])
        ;

        $event = $this->getDoctrine()
                      ->getRepository(Event::class)
                      ->findOneBy(['enabled' => true])
        ;

        $sponsorsByType = $this->getDoctrine()
                               ->getRepository(SponsorType::class)
                               ->findBy(['enabled' => true])
        ;

        $intervenantsByType = $this->getDoctrine()
                                   ->getRepository(ParticipantType::class)
                                   ->findOneBy(['label' => 'Intervenant'])
        ;

        $menus = $this->getDoctrine()
            ->getRepository(Menu::class)
            ->findAll()
        ;

        $hotels = $this->getDoctrine()
                       ->getRepository(Hotel::class)
                       ->findBy(['enabled' => true])
        ;

        $devises = $this->getDoctrine()
            ->getRepository(Devise::class)
            ->findBy(['enabled' => true])
        ;
        return $this->render(
            'front/home.html.twig',
            [
                'configuration'      => $configuration,
                'event'              => $event,
                'intervenantsByType' => $intervenantsByType,
                'sponsorsByType'     => $sponsorsByType,
                'menus'              => $menus,
                'hotels'             => $hotels,
                'devises'             => $devises

            ]
        );

//        return $this->json([
//            'message' => 'Welcome to your new controller!',
//            'path' => 'src/Controller/FrontController.php',
//        ]);
    }

    /**
     * Matches /contact exactly
     * @Route("/contact", name="contact_page")
     */
    public function contact(Request $request, \Swift_Mailer $mailer)
    {
        $configuration = $this->getDoctrine()
            ->getRepository(Configuration::class)
            ->findOneBy(['enabled' => true])
        ;

        $event = $this->getDoctrine()
                      ->getRepository(Event::class)
                      ->findOneBy(['enabled' => true])
        ;

        $menus = $this->getDoctrine()
                      ->getRepository(Menu::class)
                      ->findAll()
        ;

        $form = $this->createForm('App\Form\ContactType');

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $name    = $form['name']->getData();
            $email   = $form['from']->getData();
            $subject = $form['subject']->getData();
            $message = $form['message']->getData();


            $no_reply = (new \Swift_Message('Mail Envoyé'))
                ->setFrom('no-reply@conf2018.com')
                ->setTo($email)
                ->setBody(
                    $this->renderView(
                        'front/no-reply.email.html.twig',
                        [
                            'name' => $name,
                        ]
                    )
                )
            ;
            $mailer->send($no_reply);
            $configuration = $this->getDoctrine()
                ->getRepository(Configuration::class)
                ->findOneBy(['enabled' => true])
            ;
            if(!empty($configuration)){
                $emailConf= $configuration->getEmailDirection();
                $costumer = (new \Swift_Message('[Conf2018] Un contact via site web'))
                    ->setFrom('no-reply@conf2018.com')
                    ->setTo($emailConf)
                    ->setBody(
                        $this->renderView(
                            'front/sendemail.html.twig',
                            [
                                'name'    => $name,
                                'email'   => $email,
                                'subject' => $subject,
                                'message' => $message,
                            ]
                        )
                    )
                ;
                $mailer->send($costumer);
            }





            $this->addFlash(
                'success',
                'Email envoyé avec succès!'
            );

            // $this->addFlash() is equivalent to $request->getSession()->getFlashBag()->add()

            return $this->redirectToRoute('contact_page');
        }
        $devises = $this->getDoctrine()
            ->getRepository(Devise::class)
            ->findBy(['enabled' => true])
        ;
        return $this->render(
            'front/contact.html.twig',
            [
                "form"  => $form->createView(),
                'event' => $event,
                'configuration' => $configuration,
                'menus' => $menus,
                'devises'             => $devises

            ]
        );
    }

    /**
     * Matches /page/*
     * @Route("/page/{slug}", name="cms_page")
     */
    public function page(Request $request, $slug)
    {
        $page = $this->getDoctrine()
                     ->getRepository(Page::class)
                     ->findOneBy(['enabled' => true, 'slug' => $slug])
        ;


        $event = $this->getDoctrine()
                      ->getRepository(Event::class)
                      ->findOneBy(['enabled' => true])
        ;

        $menus = $this->getDoctrine()
            ->getRepository(Menu::class)
            ->findAll()
        ;
        $devises = $this->getDoctrine()
            ->getRepository(Devise::class)
            ->findBy(['enabled' => true])
        ;

        $sponsorsByType = $this->getDoctrine()
            ->getRepository(SponsorType::class)
            ->findBy(['enabled' => true])
        ;

        $configuration = $this->getDoctrine()
            ->getRepository(Configuration::class)
            ->findOneBy(['enabled' => true])
        ;
        return $this->render(
            'front/page.html.twig',
            [

                'event' => $event,
                'menus' => $menus,
                'sponsorsByType'=>$sponsorsByType,
                'page'  => $page,
                'configuration'  => $configuration,
                'devises'             => $devises
            ]
        );

    }

    /**
     * Matches /intervenant/*
     * @Route("/intervenant/{slug}", name="intervenant_page")
     */
    public function speaker(Request $request, $slug)
    {

        $intervenant = $this->getDoctrine()
                            ->getRepository(Participant::class)
                            ->findOneBy(['enabled' => true, 'slug' => $slug])
        ;


        $event = $this->getDoctrine()
                      ->getRepository(Event::class)
                      ->findOneBy(['enabled' => true])
        ;
        $menus = $this->getDoctrine()
            ->getRepository(Menu::class)
            ->findAll()
        ;
        $devises = $this->getDoctrine()
            ->getRepository(Devise::class)
            ->findBy(['enabled' => true])
        ;
        $configuration = $this->getDoctrine()
            ->getRepository(Configuration::class)
            ->findOneBy(['enabled' => true])
        ;
        return $this->render(
            'front/speaker.details.html.twig',
            [

                'event'       => $event,
                'configuration'       => $configuration,
                'menus'       => $menus,
                'intervenant' => $intervenant,
                'devises'             => $devises
            ]
        );
    }

    /**
     * Matches /inscription exactly
     * @Route("/inscription", name="inscription_page")
     */
    public function registration(Request $request)
    {
        $query=$request->query->has('from') || !$request->query->has('tarif')  ;
       
        $event = $this->getDoctrine()
                      ->getRepository(Event::class)
                      ->findOneBy(['enabled' => true]);

        $menus = $this->getDoctrine()
            ->getRepository(Menu::class)
            ->findAll()
        ;

        $session = $request->getSession();

        $bags = $session->get('registration_bags');

        if (empty($bags)) {
            $bags = [
                'informations'      => [],
                'hotels'            => [],
                'supplements'       => [],
                'hotelDateDebut'    => null,
                'hotelDateFin'      => null,
                'hotelPackageTotal' => 0,
                'supplementTotal'   => 0,
                'step'              => 0,
                'withEvent'         => false,
                'tarifEvent'        => 0,
                'withHotel'         => false
            ];

        }
        $bags['step'] = 1;
        $tarif = $request->get('tarif');

        if(!empty($tarif)){
            $tarifEntity = $this->getDoctrine()
                ->getRepository(Tarif::class)
                ->find($tarif)
            ;
//
            if(!empty($tarifEntity)){
                $bags['withEvent']         = true;
                $bags['tarifEvent']        = $tarifEntity->getPrix();
                $bags['tarifLabel']        = $tarifEntity->getLabel();
                $bags['tarifId']=$tarifEntity->getId();
            }
        }

        $tarifPriceAccompagnants=null;
        $session->set('registration_bags', $bags);
        $resultOrganisme=[];
        if(isset($bags['tarifLabel'])){

            $tarif=$this->getDoctrine()->getRepository(Tarif::class)->findOneBy(['event'=>$event->getId(),'label'=>$bags['tarifLabel']]);

            $tarifPriceAccompagnants=$tarif->getPrixAccompagnant();

            if(strtolower($bags['tarifLabel'])== 'membre'){
                $organisme=$this->getDoctrine()->getRepository(Organization::class)->findAll();
                foreach($organisme as $item){
                    $resultOrganisme[$item->getId()]=$item->getSociety();
                }
            }
        }

        $bags['tarifAcco']=$tarifPriceAccompagnants;


        $form = $this->createForm('App\Form\Front\InformationType',null,[
            'organisme'=>$resultOrganisme,
            'tarifPriceAccompagnants'=>$tarifPriceAccompagnants,
        ]);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
//            $user = $this->getDoctrine()
//                         ->getRepository(Participant::class)
//                         ->findOneBy(['email' => $form->get('email')->getData()])
//            ;
//            if (!empty($user)) {
//                $form->get('email')->addError(
//                    new FormError("L'adresse email existe déja")
//                )
//                ;
//
//            } else {

                $bags['informations'] = $form->getData();

                $bags['accom']=$request->request->get('accom');


                $route = 'inscription_confirmation_page';

                $session->set('registration_bags', $bags);


                return $this->redirect($this->generateUrl($route));
           // }
        }
        $devises = $this->getDoctrine()
            ->getRepository(Devise::class)
            ->findBy(['enabled' => true])
        ;
        $configuration = $this->getDoctrine()
            ->getRepository(Configuration::class)
            ->findOneBy(['enabled' => true])
        ;
        return $this->render(
            'front/registration.html.twig',
            [
                "form"  => $form->createView(),
                'event' => $event,
                'configuration' => $configuration,
                'menus' => $menus,
                'bags'              => $bags,
                'step'  => $bags['step'],
                'devises'             => $devises,
                'query'=>$query
            ]
        );
    }



    /**
     * Matches /inscription/hotels exactly
     * @Route("/inscription/hotels", name="inscription_hotel_page")
     */
    public function registrationHotels(Request $request)
    {
        $event = $this->getDoctrine()
                      ->getRepository(Event::class)
                      ->findOneBy(['enabled' => true])
        ;
        $menus = $this->getDoctrine()
            ->getRepository(Menu::class)
            ->findAll()
        ;


        $hotels = $this->getDoctrine()
                       ->getRepository(Hotel::class)
                       ->findBy(['enabled' => true])
        ;
        $configuration = $this->getDoctrine()
            ->getRepository(Configuration::class)
            ->findOneBy(['enabled' => true])
        ;
        $session = $request->getSession();

        $bags = $session->get('registration_bags');

        if (empty($bags)) {
            $bags = [
                'informations'      => [],
                'hotels'            => [],
                'supplements'       => [],
                'hotelDateDebut'    => null,
                'hotelDateFin'      => null,
                'hotelPackageTotal' => 0,
                'supplementTotal'   => 0,
                'step'              => 0,
                'withEvent'         => false,
                'tarifEvent'        => 0,
                'withHotel'         => false
            ];

        }
        $bags['step'] = 2;
        $bags['withHotel'] = true;
        $session->set('registration_bags', $bags);




        if ($request->getMethod() == 'POST') {

            $nbNights = 1;
            if (!empty($request->get('hotelDateDebut')) && !empty($request->get('hotelDateFin'))) {
                $bags['hotelDateDebut'] = $request->get('hotelDateDebut');
                $bags['hotelDateFin'] = $request->get('hotelDateFin');

                $nbNights = \App\Utils\DateUtils::numberDaysBetween($bags['hotelDateDebut'], $bags['hotelDateFin']);
                $session->set('registration_bags', $bags);
            }else {
                $this->addFlash(
                    'danger',
                    'Vous devez selectionner au moins un package!'
                );
                return $this->redirect($this->generateUrl('inscription_hotel_page'));
            }




            //Hotel Package
            $packageTotal = 0;
            if (!empty($request->get('hotel'))) {

                $countp = 0;

                $hotels = $request->get('hotel');

                foreach ($hotels as $hotel) {
                    foreach ($hotel["packages"] as $package) {
                        if (isset($package["id"]) && $package["quantity"] > 0) {
                            $countp++;
                            $item         = $this->getDoctrine()->getRepository('App\Entity\HotelPackage')->find(
                                $package["id"]
                            )
                            ;
                            $packageTotal = $packageTotal +
                                            ($this->get("app.twig.hotel.package.price")->getPackagePrice(
                                                    $item
                                                ) * $package["quantity"] * $nbNights);
                            $hotelObject = $this->getDoctrine()->getRepository(Hotel::class)->find($hotel['id']);
                            $bags['hotels'] = $hotel;
                            $bags['hotels']['object'] = $hotelObject->getDesignation();
                        }

                    }
                }

                if($countp == 0) {
                    $this->addFlash(
                        'danger',
                        'Vous devez selectionner au moins un package!'
                    );
                    return $this->redirect($this->generateUrl('inscription_hotel_page'));
                }

                $bags['hotelPackageTotal'] = $packageTotal;
                $session->set('registration_bags', $bags);
            }


            $session->set('registration_bags', $bags);

            $route = 'inscription_page';
            return $this->redirect($this->generateUrl($route,['from'=>'hotel']));
        }

        $devises = $this->getDoctrine()
            ->getRepository(Devise::class)
            ->findBy(['enabled' => true])
        ;
        return $this->render(
            'front/registration.html.twig',
            [
                "hotels" => $hotels,
                'event'  => $event,
                'configuration'  => $configuration,
                'menus'  => $menus,
                'bags'              => $bags,
                'step'   => $bags['step'],
                'devises'             => $devises
            ]
        );
    }

    /**
     * Matches /inscription/supplements exactly
     * @Route("/inscription/supplements", name="inscription_supplements_page")
     */
    public function registrationSupplements(Request $request)
    {
        $event = $this->getDoctrine()
                      ->getRepository(Event::class)
                      ->findOneBy(['enabled' => true])
        ;
        $menus = $this->getDoctrine()
            ->getRepository(Menu::class)
            ->findAll()
        ;



        $session = $request->getSession();
        $bags    = $session->get('registration_bags');
        if (empty($bags)) {
            return $this->redirect($this->generateUrl('inscription_confirmation_hotel_page'));
        }
        $bags['step'] = 3;
        $session->set('registration_bags', $bags);

        if ($request->getMethod() == 'POST') {

            if (!empty($request->get('supplements'))) {
                $bags['supplements'] = $request->get('supplements');
                $session->set('registration_bags', $bags);


            }

            return $this->redirect($this->generateUrl('inscription_confirmation_page'));
        }
        $devises = $this->getDoctrine()
            ->getRepository(Devise::class)
            ->findBy(['enabled' => true])
        ;

        $configuration = $this->getDoctrine()
            ->getRepository(Configuration::class)
            ->findOneBy(['enabled' => true])
        ;
        return $this->render(
            'front/registration.html.twig',
            [
                'event'       => $event,
                'configuration'       => $configuration,
                'menus'       => $menus,
                'bags'              => $bags,
                'step'        => $bags['step'],
                'devises'             => $devises
            ]
        );
    }


    /**
     * Matches /inscription/confirmation exactly
     * @Route("/inscription/confirmation", name="inscription_confirmation_page")
     */
    public function registrationConfirmation(Request $request, \Swift_Mailer $mailer)
    {

        $event = $this->getDoctrine()
                      ->getRepository(Event::class)
                      ->findOneBy(['enabled' => true])
        ;
        $menus = $this->getDoctrine()
            ->getRepository(Menu::class)
            ->findAll()
        ;
        $configuration = $this->getDoctrine()
                              ->getRepository(Configuration::class)
                              ->findOneBy(['enabled' => true])
        ;
        $passwordtmp = '';

        $em      = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $bags    = $session->get('registration_bags');


        if (empty($bags)) {
            return $this->redirect($this->generateUrl('inscription_page'));
        }
        $bags['step'] = 4;
        $session->set('registration_bags', $bags);



        $array_packages = [];
        if (!empty($bags['hotels'])) {
            foreach ($bags['hotels']['packages'] as $key => $package_item) {
                if (isset($package_item['id'])) {
                    if($package_item['quantity'] > 0){
                    $package = $em->getRepository('App\Entity\HotelPackage')->find($package_item['id']);

                    $temparr = ["package" => $package, "quantity" => $package_item['quantity']];
                    array_push($array_packages, $temparr);
                    }

                }
            }
        }

        $array_supplements = [];
        if (!empty($bags['supplements'])) {
            foreach ($bags['supplements'] as $key => $supplement_id) {

                $supplement = $em->getRepository('App\Entity\Supplement')->find($supplement_id);

                array_push($array_supplements, $supplement);


            }
        }

        $devises = $this->getDoctrine()
            ->getRepository(Devise::class)
            ->findBy(['enabled' => true])
        ;

        $nbNights = 1;
        if (!empty($bags['hotelDateDebut']) && !empty($bags['hotelDateFin'])) {
            $nbNights = \App\Utils\DateUtils::numberDaysBetween($bags['hotelDateDebut'], $bags['hotelDateFin']);
        }

        if ($request->getMethod() == 'POST') {



           if(!isset($bags['file'])){


               $pdfOptions = new Options();
               $pdfOptions->set('defaultFont', 'Arial');

               // Instantiate Dompdf with our options
               $dompdf = new Dompdf($pdfOptions);
               $logo1 = $this->get('kernel')->getRootDir() . '/../public/uploads/events/'.$event->getLogoFacture() ;
               $normalizer = new DataUriNormalizer();
               $avatar = $normalizer->normalize(new \SplFileObject($logo1));
               
               // Retrieve the HTML generated in our twig file
               $html = $this->renderView('front/registration/pdf/pdf.html.twig',
                   [

                       'event'             => $event,
                       'configuration'     => $configuration,
                       'avatar'     => $avatar,
                       'base_dir' => $this->get('kernel')->getRootDir() . '/../public/',
                       'menus'             => $menus,
                       'bags'              => $bags,
                       'array_packages'    => $array_packages,
                       'array_supplements' => $array_supplements,
                       'step'              => $bags['step'],
                       'devises'             => $devises,
                       'nbNights' => $nbNights
                   ]);

               // Load HTML to Dompdf
               $dompdf->loadHtml($html);
               // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
               $dompdf->setPaper('A4', 'portrait');
               // Render the HTML as PDF
               $dompdf->render();
               // Store PDF Binary Data
               $output = $dompdf->output();
               $file = $this->generateRandomString().'.pdf';
               $pdfFilepath =  $this->container->getParameter('pdf_directory') .$file;
               // Write file to the desired path
               file_put_contents($pdfFilepath, $output);
               $bags['file']=$file;
             if($bags['withEvent']){
                 $dompdf2 = new Dompdf($pdfOptions);

                 $html2 = $this->renderView('front/registration/pdf/pdfAcco.html.twig',
                     [

                         'event'             => $event,
                         'configuration'     => $configuration,
                         'avatar'     => $avatar,
                         'base_dir' => $this->get('kernel')->getRootDir() . '/../public/',
                         'menus'             => $menus,
                         'bags'              => $bags,
                         'array_packages'    => $array_packages,
                         'array_supplements' => $array_supplements,
                         'step'              => $bags['step'],
                         'devises'             => $devises,
                         'nbNights' => $nbNights
                     ]);

                 // Load HTML to Dompdf
                 $dompdf2->loadHtml($html2);
                 // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
                 $dompdf2->setPaper('A4', 'portrait');
                 // Render the HTML as PDF
                 $dompdf2->render();
                 // Store PDF Binary Data
                 $output2 = $dompdf2->output();
                 $file2 = $this->generateRandomString().'.pdf';
                 $pdfFilepath2 =  $this->container->getParameter('pdf_directory') .$file2;
                 // Write file to the desired path
                 file_put_contents($pdfFilepath2, $output2);
                 $bags['file2']=$file2;
             }
           }
            
            







            if(empty($this->getUser()) && empty($bags['informations'])){

                return $this->redirect($this->generateUrl('inscription_page'));
            }

            $reservation = null;
            $participant = null;
            if(!empty($this->getUser())){
                $reservation = $this->getDoctrine()
                    ->getRepository(Reservation::class)
                    ->findOneBy(['participant' => $this->getUser()->getId()])
                ;

                if (empty($reservation)) {
                    throw new \Exception('Vous devez vous inscrire avant de reserver un logement');
                }
            }

            if(!empty($bags['informations']['email'])){
                $participant = $this->getDoctrine()
                    ->getRepository(Participant::class)
                    ->findOneBy(['email' => $bags['informations']['email']])
                ;


                if (!empty($participant)) {
                    $reservation = $this->getDoctrine()
                        ->getRepository(Reservation::class)
                        ->findOneBy(['participant' => $participant->getId()])
                    ;
                }
            }

            $payment_method = 2;
            if(isset($_POST['paymentMethod'])){
                $payment_method = $_POST['paymentMethod'];
            }

            if (empty($reservation)) {
                $reservation = new Reservation();
            }
            if($bags['withEvent']){
                $reservationEvent = new ReservationEvent();
                $reservationEvent->setEvent($event);
                $totalAc=0;
                if(isset($bags['accom'])){
                    if(!empty($bags['accom'])){
                        $nbAccompagnat = sizeof($bags['accom']);
                        $totalAc = $bags['tarifAcco']*$nbAccompagnat;
                    }
                }
                $reservationEvent->setTotal($bags['tarifEvent']+$totalAc);
                if(isset($bags['tarifId'])){
                    $reservationEvent->setTarifId($bags['tarifId']);
                }
                $reservationEvent->setPaymentMethod($payment_method);
                if(isset($bags['informations']['hotel'])){
                    $hotelObject = $this->getDoctrine()->getRepository(Hotel::class)->find($bags['informations']['hotel']);
                    $reservationEvent->setHotel($hotelObject);
                }
                if(isset($bags['file'])){
                    $reservationEvent->setDevis($bags['file']);
                }
                if(isset($bags['file2'])){
                    $reservationEvent->setDevisAcco($bags['file2']);
                }

                $em->persist($reservationEvent);
                $bags['hotelPersist']=false ;
                $total_price = (empty($reservation->getTotalPrice()))?0: $reservation->getTotalPrice();
                $reservation->setTotalPrice(($total_price + $reservationEvent->getTotal()));

                $reservation->addReservationsEvent($reservationEvent);
            }

                    if (!empty($bags['informations'])) {

                        if(empty($participant)){
                            $participant = new Participant();

                            $role = $this->getDoctrine()
                                ->getRepository(Role::class)
                                ->findOneBy(['name' => 'ROLE_USER'])
                            ;
                            $participant->addRole($role);

                            $participantType = $this->getDoctrine()
                                ->getRepository(ParticipantType::class)
                                ->findOneBy(['label' => 'Participant'])
                            ;
                            $participant->setType($participantType);
                        }


                    $participant->setFirstname($bags['informations']['firstname']);
                    $participant->setLastname($bags['informations']['lastname']);
                    $participant->setUsername($bags['informations']['firstname'].' '.$bags['informations']['lastname']);
                    $participant->setEmail($bags['informations']['email']);


                    $name = $bags['informations']['firstname'].' '.$bags['informations']['lastname'];

                    if (!empty($bags['informations']['societe'])) {
                        $society=$bags['informations']['societe'];
                        if(is_numeric ($society)){
                            $organisme=$this->getDoctrine()->getRepository(Organization::class)->find($society);
                            $society=$organisme->getSociety();
                        }
                        $participant->setSociete($society);
                    }
                    if (!empty($bags['informations']['poste'])) {
                        $participant->setPoste($bags['informations']['poste']);
                    }

                    $participant->setTelephone($bags['informations']['telephone']);

                    if(isset($bags['informations']['dateArrive'])){
                        $participant->setDateArrive($bags['informations']['dateArrive']);
                    }
                    if(isset($bags['informations']['dateDepart'])){
                        $participant->setDateDepart($bags['informations']['dateDepart']);
                    }
                    if(isset($bags['informations']['numVolArrive'])){
                        $participant->setNumVolArrive($bags['informations']['numVolArrive']);
                    }
                    if(isset($bags['informations']['numVolDepart'])){
                        $participant->setNumVolDepart($bags['informations']['numVolDepart']);
                    }
                    if(isset($bags['informations']['nationalite'])){
                        $participant->setNationalite($bags['informations']['nationalite']);
                    }
                if(isset($bags['informations']['address'])){
                    $participant->setAddress($bags['informations']['address']);
                }
                if(isset($bags['informations']['codePostal'])){
                    $participant->setCodePostal($bags['informations']['codePostal']);
                }
                if(isset($bags['informations']['country'])){
                    $participant->setCountry($bags['informations']['country']);
                }
                if(isset($bags['informations']['pays'])){
                    $paysObject = $this->getDoctrine()->getRepository(Pays::class)->find($bags['informations']['pays']);
                    $participant->setPays($paysObject);
                }
                if(isset($bags['informations']['heureArrival'])){
                    $participant->setHeureArrival($bags['informations']['heureArrival']);
                }
                if(isset($bags['informations']['heureDeparture'])){
                    $participant->setHeureDeparture($bags['informations']['heureDeparture']);
                }
                   if(isset($bags['informations']['nbAccompanying'])){
                 $participant->setNbAccompanying($bags['informations']['nbAccompanying']);

                    }


                        if(isset($bags['accom'])){

                            foreach($bags['accom'] as $item){
                                $accompagnant= new Accompanying();
                                $accompagnant->setLastname($item['Nom']);
                                $accompagnant->setFirtname($item['Prenom']);
                                $accompagnant->setType($item['relation']);
                                $accompagnant->setReservation($reservation);
                                $reservation->addAccompanying($accompagnant);
                                $em->persist($accompagnant);

                            }
                            $em->flush();
                        }

//                    if(empty($participant->getPassword()) || empty($participant->getSalt())){
                        //*envoi de mail ici */
                        $password    = CodeGenerator::codeGeneratorForPassword();
                        $passwordtmp = $password;
                        $participant->setSalt(md5(uniqid()));

                        // the 'security.password_encoder' service requires Symfony 2.6 or higher
                        $encoder  = $this->container->get('security.password_encoder');
                        $password = $encoder->encodePassword($participant, $password);
                        $participant->setPassword($password);
                        
                        
//                    }


                        if(is_null($participant->getId())){

                            $em->persist($participant);
                            $em->flush();
                        }
                        $reservation->setParticipant($participant);




                    $total_price = (empty($reservation->getTotalPrice()))?0: $reservation->getTotalPrice();
                    $reservation->setTotalPrice(($total_price));
                    $reservation->setState(0);
                        
                    $reservation->setReservationRef(uniqid('RES'));

                        if(isset($bags['informations']['dateArrive'])){
                            $reservation->setDateArrive($bags['informations']['dateArrive']);
                        }
                        if(isset($bags['informations']['dateDepart'])){
                            $reservation->setDateDepart($bags['informations']['dateDepart']);
                        }
                        if(isset($bags['informations']['numVolArrive'])){
                            $reservation->setNumVolArrive($bags['informations']['numVolArrive']);
                        }
                        if(isset($bags['informations']['numVolDepart'])){
                            $reservation->setNumVolDepart($bags['informations']['numVolDepart']);
                        }
                        if(isset($bags['informations']['heureArrival'])){
                            $reservation->setHeureArrival($bags['informations']['heureArrival']);
                        }
                        if(isset($bags['informations']['heureDeparture'])){
                            $reservation->setHeureDeparture($bags['informations']['heureDeparture']);
                        }
                        if(isset($bags['informations']['nbAccompanying'])){
                            $reservation->setNbAccompanying($bags['informations']['nbAccompanying']);

                        }

                        $session->set('user_password', $passwordtmp);
                    $session->set('registration_bags', $bags);
                    $em->persist($reservation);
                    $em->flush();

                        $logo = $this->get('kernel')->getRootDir() . '/../public/uploads/events/'.$event->getLogoFacture() ;
                        $normalizer = new DataUriNormalizer();
                        $avatar = $normalizer->normalize(new \SplFileObject($logo));
                    $html   = $this->renderView(
                        'front/registration/reservation.ticket.html.twig',
                        [
                            'event'         => $event,
                            'avatar'         => $avatar,
                            'configuration' => $configuration,
                            'bags'          => $bags,
                        ]
                    );

                    try {

                        $pdfOptions = new Options();
                        $pdfOptions->set('defaultFont', 'Arial');

                        // Instantiate Dompdf with our options
                        $dompdf = new Dompdf($pdfOptions);

                        // Retrieve the HTML generated in our twig file

                        // Load HTML to Dompdf
                        $dompdf->loadHtml($html);

                        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
                        $dompdf->setPaper('A4', 'portrait');

                        // Render the HTML as PDF
                        $dompdf->render();
  

                        $output = $dompdf->output();
                        $content_pdf = new \Swift_Attachment(
                            $output,
                            'ticket_reservation_'.$reservation->getId().'.pdf',
                            'application/pdf'
                        );

                        $message = (new \Swift_Message('Inscription FANAF 2019'))
                            ->setFrom('no-reply@fanaf2019.org')
                            ->setTo($participant->getEmail())
                            ->setBody(
                                $this->renderView(
                                    'front/emails/email.registration.html.twig',
                                    [
                                        'name'     => $name,
                                        'password' => $passwordtmp,

                                    ]
                                ),
                                'text/html'
                            )
                            ->attach($content_pdf)
                        ;

                        $mailer->send($message);

                    } catch (\RuntimeException $e) {

                    }

//                     
                        
                    if (empty($bags['hotels'])){
                        return $this->redirect($this->generateUrl('inscription_success_page'));
                    }
                        
                        
                }


            //hotel supplement

        if(!empty($bags['hotels']) || !empty($bags['supplements'])){
            if (!empty($bags['hotels'])) {

                $hotel            = $em->getRepository('App\Entity\Hotel')->find($bags['hotels']['id']);
                $reservationHotel = new ReservationHotel();


                $reservationHotel->setTotal($bags['hotelPackageTotal']);
                $nbNights = \App\Utils\DateUtils::numberDaysBetween($bags['hotelDateDebut'], $bags['hotelDateFin']);

                $reservationHotel->setNbJours($nbNights);

                $reservationHotel->setDateDebut(new \DateTime($bags['hotelDateDebut']));
                $reservationHotel->setDateFin(new \DateTime($bags['hotelDateFin']));

                $reservationHotel->setHotel($hotel);

                $reservationHotel->setPaymentMethod($payment_method);
                if(isset($bags['file'])){
                    $reservationHotel->setDevis($bags['file']);
                }

                foreach ($array_packages as $key => $package_item) {
                    $hotelReservationPackage = new HotelReservationPackage();


                    $package = $em->getRepository('App\Entity\HotelPackage')->find($package_item['package']->getId());
                    $hotelReservationPackage->setPackage($package);
                    $hotelReservationPackage->setQuantity($package_item['quantity']);
                    $hotelReservationPackage->setReservationHotel($reservationHotel);


                    $em->persist($hotelReservationPackage);


                    $reservationHotel->addHotelReservationsPackage($hotelReservationPackage);

                }
                $total_price = (empty($reservation->getTotalPrice()))?0: $reservation->getTotalPrice();
                $reservation->setTotalPrice(($total_price + $reservationHotel->getTotal()));

                $em->persist($reservationHotel);
                $bags['hotelPersist']=true ;
                $reservation->addReservationsHotel($reservationHotel);

            }

            if (!empty($bags['supplements'])) {

                $reservationSupplements = new ReservationSupplements();

                foreach ($bags['supplements'] as $key => $supplement_item) {

                    $supplement = $this->getDoctrine()->getRepository('App:Supplement')->find($supplement_item);

                    $reservationSupplements->addSupplement($supplement);
                    $bags['supplementTotal'] = $bags['supplementTotal'] + $supplement->getPrix();
                }

                $reservationSupplements->setTotal($bags['supplementTotal']);
                $reservationSupplements->setPaymentMethod($payment_method);


                $total_price = (empty($reservation->getTotalPrice()))?0: $reservation->getTotalPrice();
                $reservation->setTotalPrice(($total_price + $reservationSupplements->getTotal()));

                $reservationSupplements->setReservation($reservation);
                $em->persist($reservationSupplements);
                $reservation->addReservationsSupplement($reservationSupplements);

            }

            $session->set('registration_bags', $bags);

            $em->persist($reservation);
            $em->flush();

            if($bags['withEvent']){
                $bags['reservationId']= $reservationEvent->getId();
            }
            if($bags['withHotel']) {
                $bags['reservationId']= $reservationHotel->getId();
            }



            $session->set('registration_bags', $bags);
            $file = $this->get('kernel')->getRootDir() . '/../public/uploads/events/'.$event->getLogoFacture() ;
            $normalizer = new DataUriNormalizer();
            $avatar = $normalizer->normalize(new \SplFileObject($file));


            $html   = $this->renderView(
                'front/registration/reservation.hotel.ticket.html.twig',
                [
                    'event'         => $event,
                    'configuration' => $configuration,
                    'bags'          => $bags,
                    'avatar'          => $avatar,
                    'reservation' => $reservation,
                    'array_packages'    => $array_packages,
                    'array_supplements' => $array_supplements,
                ]
            );

            try {




                $pdfOptions = new Options();
                $pdfOptions->set('defaultFont', 'Arial');

                // Instantiate Dompdf with our options
                $dompdf = new Dompdf($pdfOptions);

                // Retrieve the HTML generated in our twig file

                // Load HTML to Dompdf
                $dompdf->loadHtml($html);

                // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
                $dompdf->setPaper('A4', 'portrait');

                // Render the HTML as PDF
                $dompdf->render();


                $output = $dompdf->output();




                $content_pdf = new \Swift_Attachment(
                    $output,
                    'ticket_reservation_logement_'.$reservation->getId().'.pdf',
                    'application/pdf'
                );
                $participant = $reservation->getParticipant();
                $name = $participant->getName();
                $message = (new \Swift_Message('Réservation Logement FANAF 2019'))
                    ->setFrom('no-reply@fanaf2019.org')
                    ->setTo($participant->getEmail())
                    ->setBody(
                        $this->renderView(
                        // templates/emails/registration.html.twig
                            'front/emails/email.hotel.reservation.html.twig',
                            [
                                'name'     => $name,
                                'hotel' => $hotel,

                            ]
                        ),
                        'text/html'
                    )
                    ->attach($content_pdf)
                ;

                $mailer->send($message);

            } catch (\RuntimeException $e) {

            }
}
            if($bags['withEvent']){
                $bags['reservationId']= $reservationEvent->getId();
            }
            if($bags['withHotel']) {
                $bags['reservationId']= $reservationHotel->getId();
            }



            $session->set('registration_bags', $bags);


            return $this->redirect($this->generateUrl('inscription_success_page'));
        }


        $devises = $this->getDoctrine()
            ->getRepository(Devise::class)
            ->findBy(['enabled' => true])
        ;

        $nbNights = 1;
        if (!empty($bags['hotelDateDebut']) && !empty($bags['hotelDateFin'])) {
            $nbNights = \App\Utils\DateUtils::numberDaysBetween($bags['hotelDateDebut'], $bags['hotelDateFin']);
        }
        return $this->render(
            'front/registration.html.twig',
            [
                'event'             => $event,
                'configuration'     => $configuration,
                'menus'             => $menus,
                'bags'              => $bags,
                'array_packages'    => $array_packages,
                'array_supplements' => $array_supplements,
                'step'              => $bags['step'],
                'devises'             => $devises,
                'nbNights' => $nbNights
            ]
        );

    }

    /**
     * Matches /inscription/success exactly
     * @Route("/inscription/success", name="inscription_success_page")
     */
    public function registrationSuccess(Request $request)
    {
        $session = $request->getSession();
        $bags    = $session->get('registration_bags');

        if (empty($bags)) {
            return $this->redirect($this->generateUrl('inscription_page'));
        }
        $bags['step'] = 5;
        $session->set('registration_bags', $bags);

        $success_hotel = false;

        if (!empty($bags['hotels'])) {
            $success_hotel = true;

        }
        
        




        $event = $this->getDoctrine()
                      ->getRepository(Event::class)
                      ->findOneBy(['enabled' => true])
        ;
        $menus = $this->getDoctrine()
            ->getRepository(Menu::class)
            ->findAll()
        ;

        $password = $session->get('user_password');
        $session->remove('user_password');
        $session->remove('registration_bags');
        $devises = $this->getDoctrine()
            ->getRepository(Devise::class)
            ->findBy(['enabled' => true])
        ;

        $configuration = $this->getDoctrine()
            ->getRepository(Configuration::class)
            ->findOneBy(['enabled' => true])
        ;

        return $this->render(
            'front/registration.html.twig',
            [
                'event'         => $event,
                'configuration'         => $configuration,
                'menus'         => $menus,
                'bags'          => $bags,
                'step'          => $bags['step'],
                'success_hotel' => $success_hotel,
                'password'      => $password,
                'devises'       => $devises
            ]
        );

    }

    /**
     * Matches /hotel/detail/*
     * @Route("/hotel/detail/{hotel}", name="hotel_detail_page")
     */
    public function hotelDetails(Request $request, Hotel $hotel)
    {

        $event   = $this->getDoctrine()
                        ->getRepository(Event::class)
                        ->findOneBy(['enabled' => true])
        ;
        $menus = $this->getDoctrine()
            ->getRepository(Menu::class)
            ->findAll()
        ;

        $packages = $this->getDoctrine()->getRepository(HotelPackage::class)->findBy(['hotel' => $hotel]);
        $devises = $this->getDoctrine()
            ->getRepository(Devise::class)
            ->findBy(['enabled' => true])
        ;
        $configuration = $this->getDoctrine()
            ->getRepository(Configuration::class)
            ->findOneBy(['enabled' => true])
        ;

        return $this->render(
            'front/registration/hotel.details.html.twig',
            [


                'event'    => $event,
                'configuration'    => $configuration,
                'menus'    => $menus,
                'hotel'    => $hotel,
                'packages' => $packages,
                'devises'             => $devises
            ]
        );
    }

    /**
     * @Route("/profile", name="front_profile")
     */
    public function profile(Request $request)
    {

        // The second parameter is used to specify on what object the role is tested.
        $this->denyAccessUnlessGranted('ROLE_USER', null, 'Unable to access this page!');

        $event   = $this->getDoctrine()
                        ->getRepository(Event::class)
                        ->findOneBy(['enabled' => true])
        ;
        $menus = $this->getDoctrine()
            ->getRepository(Menu::class)
            ->findAll()
        ;

        $participant = $this->getDoctrine()
                            ->getRepository(Participant::class)
                            ->find($this->getUser()->getId())
        ;
        $devises = $this->getDoctrine()
            ->getRepository(Devise::class)
            ->findBy(['enabled' => true])
        ;

        $configuration = $this->getDoctrine()
            ->getRepository(Configuration::class)
            ->findOneBy(['enabled' => true])
        ;

        $reservation = $this->getDoctrine()
            ->getRepository(Reservation::class)
            ->findOneBy(['participant' => $this->getUser()->getId()])
        ;
        $array_packages     = [];
        $array_supplements = [];
        if(!empty($reservation)){
            $reservationsHotels = $reservation->getReservationsHotels();

            foreach ($reservationsHotels as $reservationHotel) {
                $hotelReservationsPackages = $this->getDoctrine()
                    ->getRepository(HotelReservationPackage::class)
                    ->findBy(['reservationHotel' => $reservationHotel->getId()])
                ;
                $array_packages            = $hotelReservationsPackages;
            }

            $reservationSupplements = $this->getDoctrine()
                ->getRepository(ReservationSupplements::class)
                ->findOneBy(['reservation' => $reservation->getId()])
            ;
            if(!empty($reservationSupplements)){
                $array_supplements = $reservationSupplements->getSupplements();
            }

        }









        $form = $this->createForm(ProfileType::class, $participant);
        $form->handleRequest($request);

        if($request->getMethod()=='POST'){
            $requestObject= $request->request->get('profile');

            $firstname=$requestObject['firstname'];
            $lastname=$requestObject['lastname'];
            $societe=$requestObject['societe'];
            $poste=$requestObject['poste'];
            $telephone=$requestObject['telephone'];
            $biographie=$requestObject['biographie'];
            $tweeterLink=$requestObject['tweeterLink'];
            $linkedinLink=$requestObject['linkedinLink'];
            $nationalite=$requestObject['nationalite'];
            $address=$requestObject['address'];
            $codePostal=$requestObject['codePostal'];
            $pays=$requestObject['pays'];
            $email=$requestObject['email'];
            $country=$requestObject['country'];
            $password=$requestObject['password']['first'];

            $participant->setFirstname($firstname);
            $participant->setLastname($lastname);
            $participant->setSociete($societe);
            $participant->setPoste($poste);
            $participant->setTelephone($telephone);
            $participant->setBiographie($biographie);
            $participant->setTweeterLink($tweeterLink);
            $participant->setLinkedinLink($linkedinLink);
            $participant->setNationalite($nationalite);
            $participant->setAddress($address);
            $participant->setCodePostal($codePostal);
            $participant->setCountry($country);
            $participant->setEmail($email);
            $paysObject = $this->getDoctrine()->getRepository(Pays::class)->find($pays);
            $participant->setPays($paysObject);

            $participant->setSalt(md5(uniqid()));

            // the 'security.password_encoder' service requires Symfony 2.6 or higher
            $encoder  = $this->container->get('security.password_encoder');
            $password = $encoder->encodePassword($participant, $password);


            $participant->setPassword($password);



            $this->getDoctrine()->getManager()->persist($participant);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('front_profile');
        }




        return $this->render(
            'front/profile.html.twig',
            [
                'participant'            => $participant,
                'form'                   => $form->createView(),
                'event'                  => $event,
                'configuration'          => $configuration,
                'reservation'            => $reservation,
                'menus'                  => $menus,
                'devises'                => $devises,
                'array_packages'         => $array_packages,
                'array_supplements'      => $array_supplements,
            ]
        );
    }

    /**
     * @Route("/participants", name="front_participants_list")
     */
    public function participantsList(Request $request)
    {


        $event = $this->getDoctrine()
                      ->getRepository(Event::class)
                      ->findOneBy(['enabled' => true])
        ;
        $menus = $this->getDoctrine()
            ->getRepository(Menu::class)
            ->findAll()
        ;

        $sponsorsByType = $this->getDoctrine()
            ->getRepository(SponsorType::class)
            ->findBy(['enabled' => true])
        ;
        $result=[];
        if(!empty($event)){
            $participants = $this->getDoctrine()
                ->getRepository(ReservationEvent::class)
                ->findListParticipants($event->getId())
            ;
            if(!empty($participants)){
                foreach($participants as $item){
                    $particp=$this->getDoctrine()->getRepository(Participant::class)->find($item['id']);
                    if(!empty($particp)){
                        $result[]=['Pays'=>$particp->getPays()->getName(),
                            'Oragnisme'=>$particp->getSociete(),
                            'Nom'=>$particp->getFirstname(),
                            'Prénom'=>$particp->getLastname(),
                            'Poste'=>$particp->getPoste(),
                            'Email'=>$particp->getEmail(),
                            'Tel'=>$particp->getTelephone()];
                    }

                }
            }
        }
        

        $devises = $this->getDoctrine()
            ->getRepository(Devise::class)
            ->findBy(['enabled' => true])
        ;
        $configuration = $this->getDoctrine()
            ->getRepository(Configuration::class)
            ->findOneBy(['enabled' => true])
        ;
        return $this->render(
            'front/participants.list.html.twig',
            [
                'event'        => $event,
                'configuration'        => $configuration,
                'sponsorsByType'        => $sponsorsByType,
                'menus'        => $menus,
                'participants' => $result,
                'devises'             => $devises
            ]
        );
    }


    /**
     * @Route("/live-streaming", name="front_live_streaming")
     */
    public function liveStreaming(Request $request)
    {


        $event = $this->getDoctrine()
                      ->getRepository(Event::class)
                      ->findOneBy(['enabled' => true])
        ;
        $menus = $this->getDoctrine()
            ->getRepository(Menu::class)
            ->findAll()
        ;

        $configuration = $this->getDoctrine()
            ->getRepository(Configuration::class)
            ->findOneBy(['enabled' => true])
        ;

        $devises = $this->getDoctrine()
            ->getRepository(Devise::class)
            ->findBy(['enabled' => true])
        ;
        $sponsorsByType = $this->getDoctrine()
            ->getRepository(SponsorType::class)
            ->findBy(['enabled' => true])
        ;

        return $this->render(
            'front/streaming.live.html.twig',
            [
                'event'        => $event,
                'sponsorsByType'        => $sponsorsByType,
                'configuration'        => $configuration,
                'menus'        => $menus,
                'devises'             => $devises
            ]
        );
    }

    /**
     * Matches /hotel/dates/available exactly
     * @Route("/hotel/dates/available", name="application_hotels_available_dates")
     */
    public function returnStartAvailableDates(Request $request)
    {

        $event = 1;//$request->get('event');
        $dates = [];

        $event = $this->getDoctrine()->getRepository(Event::class)->find($event);

        $dateDebut = $event->getDateDebut()->modify('-3 day');
        $dateFin   = $event->getDateFin()->modify('+4 day');



        $daterange = new \DatePeriod($dateDebut, new \DateInterval('P1D'), $dateFin);

        foreach($daterange as $date){
            $dates[] = $date->format("d-m-Y");
        }

        return new JsonResponse(array_unique($dates));
    }
    
    /**
     * @Route("/generatePdf", name="application_generate_pdf")
     */
    public function generatePdf(Request $request){

//        $array_packages = [];
//        $event = $this->getDoctrine()
//            ->getRepository(Event::class)
//            ->findOneBy(['enabled' => true])
//        ;
//        $menus = $this->getDoctrine()
//            ->getRepository(Menu::class)
//            ->findAll()
//        ;
//        $configuration = $this->getDoctrine()
//            ->getRepository(Configuration::class)
//            ->findOneBy(['enabled' => true])
//        ;
//        $session = $request->getSession();
//        $bags    = $session->get('registration_bags');
//
//        if (empty($bags)) {
//            return $this->redirect($this->generateUrl('inscription_page'));
//        }
//        if (!empty($bags['hotels'])) {
//            foreach ($bags['hotels']['packages'] as $key => $package_item) {
//                if (isset($package_item['id'])) {
//                    if($package_item['quantity'] > 0){
//                        $package =  $this->getDoctrine()
//                            ->getRepository('App\Entity\HotelPackage')->find($package_item['id']);
//
//                        $temparr = ["package" => $package, "quantity" => $package_item['quantity']];
//                        array_push($array_packages, $temparr);
//                    }
//
//                }
//            }
//        }
//
//        $array_supplements = [];
//        if (!empty($bags['supplements'])) {
//            foreach ($bags['supplements'] as $key => $supplement_id) {
//
//                $supplement =  $this->getDoctrine()
//                    ->getRepository('App\Entity\Supplement')->find($supplement_id);
//
//                array_push($array_supplements, $supplement);
//
//
//            }
//        }
//        $devises = $this->getDoctrine()
//            ->getRepository(Devise::class)
//            ->findBy(['enabled' => true])
//        ;
//
//        $nbNights = 1;
//        if (!empty($bags['hotelDateDebut']) && !empty($bags['hotelDateFin'])) {
//            $nbNights = \App\Utils\DateUtils::numberDaysBetween($bags['hotelDateDebut'], $bags['hotelDateFin']);
//        }
//        $pdfOptions = new Options();
//        $pdfOptions->set('defaultFont', 'Arial');
//
//        // Instantiate Dompdf with our options
//        $dompdf = new Dompdf($pdfOptions);
//        $logo = $this->get('kernel')->getRootDir() . '/../public/uploads/events/'.$event->getLogoFacture() ;
//        $normalizer = new DataUriNormalizer();
//        $avatar = $normalizer->normalize(new \SplFileObject($logo));
//        $html2   = $this->renderView(
//            'front/registration/pdf/pdf.html.twig',
//            [
//
//                'event'             => $event,
//                'avatar'     => $avatar,
//                'configuration'     => $configuration,
//                'base_dir' => $this->get('kernel')->getRootDir() . '/../public/',
//                'menus'             => $menus,
//                'bags'              => $bags,
//                'array_packages'    => $array_packages,
//                'array_supplements' => $array_supplements,
//                'step'              => $bags['step'],
//                'devises'             => $devises,
//                'nbNights' => $nbNights
//            ]
//        );
//
//
//        // Load HTML to Dompdf
//        $dompdf->loadHtml($html2);
//
//        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
//        $dompdf->setPaper('A4', 'portrait');
//
//        // Render the HTML as PDF
//        $dompdf->render();
//
//        // Store PDF Binary Data
//        $output = $dompdf->output();
//
//        $file = $this->generateRandomString().'.pdf';
//        $pdfFilepath =  $this->container->getParameter('pdf_directory') .$file;
//
//        // Write file to the desired path
//        file_put_contents($pdfFilepath, $output);
//
//       $bags['file']=$file;
//
//        $session->set('registration_bags', $bags);
//
//
//            $dompdf->stream("mypdf.pdf", [
//                "Attachment" => false
//            ]);


     return true;

        
    }

    function generateRandomString($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }
    /**
     * 
     * @Route("/inscrption/option", name="application_event_inscription_option")
     */
    public function registrationOption(Request $request){
        $session = $request->getSession();

        $currency = $request->get('_currency');

        $devise_criterias = ['main' => true];

        if(!empty($currency)){
            $devise_criterias = ['code' => $currency];
        }
        $devise = $this->getDoctrine()
            ->getRepository(Devise::class)
            ->findOneBy($devise_criterias)
        ;

        $session->set('currency', strtolower($devise->getCode()));
        if(empty($devise)){
            throw new \Exception('You have to define at least one main "Devise"');
        }


        $configuration = $this->getDoctrine()
            ->getRepository(Configuration::class)
            ->findOneBy(['enabled' => true])
        ;

        $event = $this->getDoctrine()
            ->getRepository(Event::class)
            ->findOneBy(['enabled' => true])
        ;

      

        $menus = $this->getDoctrine()
            ->getRepository(Menu::class)
            ->findAll()
        ;

        $hotels = $this->getDoctrine()
            ->getRepository(Hotel::class)
            ->findBy(['enabled' => true])
        ;

        $devises = $this->getDoctrine()
            ->getRepository(Devise::class)
            ->findBy(['enabled' => true])
        ;

        $sponsorsByType = $this->getDoctrine()
            ->getRepository(SponsorType::class)
            ->findBy(['enabled' => true])
        ;

        return $this->render(
            'front/registration/registrationOption.html.twig',
            [
                'configuration'      => $configuration,
                'event'              => $event,
                'menus'              => $menus,
                'sponsorsByType'     => $sponsorsByType,
                'hotels'             => $hotels,
                'devises'             => $devises

            ]
        );
    }

    /**
     *
     * @Route("/event/programm", name="application_event_program")
     */
    public function programEvent(Request $request){
        $session = $request->getSession();

        $currency = $request->get('_currency');

        $devise_criterias = ['main' => true];

        if(!empty($currency)){
            $devise_criterias = ['code' => $currency];
        }
        $devise = $this->getDoctrine()
            ->getRepository(Devise::class)
            ->findOneBy($devise_criterias)
        ;

        $session->set('currency', strtolower($devise->getCode()));
        if(empty($devise)){
            throw new \Exception('You have to define at least one main "Devise"');
        }


        $configuration = $this->getDoctrine()
            ->getRepository(Configuration::class)
            ->findOneBy(['enabled' => true])
        ;

        $event = $this->getDoctrine()
            ->getRepository(Event::class)
            ->findOneBy(['enabled' => true])
        ;



        $menus = $this->getDoctrine()
            ->getRepository(Menu::class)
            ->findAll()
        ;

        $hotels = $this->getDoctrine()
            ->getRepository(Hotel::class)
            ->findBy(['enabled' => true])
        ;

        $devises = $this->getDoctrine()
            ->getRepository(Devise::class)
            ->findBy(['enabled' => true])
        ;

        $sponsorsByType = $this->getDoctrine()
            ->getRepository(SponsorType::class)
            ->findBy(['enabled' => true])
        ;

        return $this->render(
            'front/program.html.twig',
            [
                'configuration'      => $configuration,
                'event'              => $event,
                'menus'              => $menus,
                'sponsorsByType'     => $sponsorsByType,
                'hotels'             => $hotels,
                'devises'             => $devises

            ]
        );
    }



    /**
     *
     * @Route("/event/intervenant", name="application_event_intervenant")
     */
    public function intervenantEvent(Request $request){
        $session = $request->getSession();

        $currency = $request->get('_currency');

        $devise_criterias = ['main' => true];

        if(!empty($currency)){
            $devise_criterias = ['code' => $currency];
        }
        $devise = $this->getDoctrine()
            ->getRepository(Devise::class)
            ->findOneBy($devise_criterias)
        ;

        $session->set('currency', strtolower($devise->getCode()));
        if(empty($devise)){
            throw new \Exception('You have to define at least one main "Devise"');
        }


        $configuration = $this->getDoctrine()
            ->getRepository(Configuration::class)
            ->findOneBy(['enabled' => true])
        ;

        $event = $this->getDoctrine()
            ->getRepository(Event::class)
            ->findOneBy(['enabled' => true])
        ;



        $menus = $this->getDoctrine()
            ->getRepository(Menu::class)
            ->findAll()
        ;

        $hotels = $this->getDoctrine()
            ->getRepository(Hotel::class)
            ->findBy(['enabled' => true])
        ;

        $devises = $this->getDoctrine()
            ->getRepository(Devise::class)
            ->findBy(['enabled' => true])
        ;

        $sponsorsByType = $this->getDoctrine()
            ->getRepository(SponsorType::class)
            ->findBy(['enabled' => true])
        ;
        $intervenantsByType = $this->getDoctrine()
            ->getRepository(ParticipantType::class)
            ->findOneBy(['label' => 'Intervenant'])
        ;
        return $this->render(
            'front/intervenant.html.twig',
            [
                'configuration'      => $configuration,
                'intervenantsByType'      => $intervenantsByType,
                'event'              => $event,
                'menus'              => $menus,
                'sponsorsByType'     => $sponsorsByType,
                'hotels'             => $hotels,
                'devises'             => $devises

            ]
        );
    }
    /**
     *
     * @Route("/event/sponsors", name="application_event_sponsors")
     */
    public function getListSponsors(Request $request){
        $session = $request->getSession();

        $currency = $request->get('_currency');

        $devise_criterias = ['main' => true];

        if(!empty($currency)){
            $devise_criterias = ['code' => $currency];
        }
        $devise = $this->getDoctrine()
            ->getRepository(Devise::class)
            ->findOneBy($devise_criterias)
        ;

        $session->set('currency', strtolower($devise->getCode()));
        if(empty($devise)){
            throw new \Exception('You have to define at least one main "Devise"');
        }


        $configuration = $this->getDoctrine()
            ->getRepository(Configuration::class)
            ->findOneBy(['enabled' => true])
        ;

        $event = $this->getDoctrine()
            ->getRepository(Event::class)
            ->findOneBy(['enabled' => true])
        ;



        $menus = $this->getDoctrine()
            ->getRepository(Menu::class)
            ->findAll()
        ;

        $hotels = $this->getDoctrine()
            ->getRepository(Hotel::class)
            ->findBy(['enabled' => true])
        ;

        $devises = $this->getDoctrine()
            ->getRepository(Devise::class)
            ->findBy(['enabled' => true])
        ;

        $sponsorsByType = $this->getDoctrine()
            ->getRepository(SponsorType::class)
            ->findBy(['enabled' => true])
        ;
        $intervenantsByType = $this->getDoctrine()
            ->getRepository(ParticipantType::class)
            ->findOneBy(['label' => 'Intervenant'])
        ;
        return $this->render(
            'front/sponsorspage.html.twig',
            [
                'configuration'      => $configuration,
                'intervenantsByType'      => $intervenantsByType,
                'event'              => $event,
                'menus'              => $menus,
                'sponsorsByType'     => $sponsorsByType,
                'hotels'             => $hotels,
                'devises'             => $devises

            ]
        );
    }



}
