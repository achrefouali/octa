<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\Menu;
use App\Entity\Devise;
use App\Entity\Participant;
use App\Utils\CodeGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SecurityController
 * @package App\Controller
 */
class SecurityController extends Controller
{
    /**
     * @Route("/back/login", name="back_login")
     */
    public function login(Request $request)
    {
        $authUtils = $this->get('security.authentication_utils');
        // get the login error if there is one
        $error = $authUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authUtils->getLastUsername();

        return $this->render('security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }

    /**
     * @Route("/login", name="front_login")
     */
    public function loginFront(Request $request)
    {
        $authUtils = $this->get('security.authentication_utils');
        // get the login error if there is one
        $error = $authUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authUtils->getLastUsername();

        $event = $this->getDoctrine()
            ->getRepository(Event::class)
            ->findOneBy(['enabled' => true]);

        $menus = $this->getDoctrine()
            ->getRepository(Menu::class)
            ->findBy(['enabled' => true])
        ;
        $devises = $this->getDoctrine()
            ->getRepository(Devise::class)
            ->findBy(['enabled' => true])
        ;

        return $this->render('security/login.front.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
            'event'         => $event,
            'menus'         => $menus,
            'devises'             => $devises
        ));
    }

    /**
     * @Route("/reset", name="reset_password")
     */
    public function resetPasswordFront(Request $request,\Swift_Mailer $mailer)
    {


        $event = $this->getDoctrine()
            ->getRepository(Event::class)
            ->findOneBy(['enabled' => true]);

        $menus = $this->getDoctrine()
            ->getRepository(Menu::class)
            ->findBy(['enabled' => true])
        ;
        $devises = $this->getDoctrine()
            ->getRepository(Devise::class)
            ->findBy(['enabled' => true])
        ;
        $error ="";
        $valid ="";
        if ($request->getMethod()=='POST') {
            if(!$request->request->has('_email')){
                throw new Exception('email required');
            }
            $email = $request->request->get('_email');
           
            $participant = $this->getDoctrine()->getRepository(Participant::class)->findOneBy(['email'=>$email]);
          
            if(is_null($participant)){
              
                $error ='Particpant non trouvé';
                return $this->render('security/reset.front.html.twig', array(
                    'error'=> $error,
                    'event'         => $event,
                    'menus'         => $menus,
                    'valid' => $valid,
                    'devises'             => $devises
                ));
            }
            $passwordGen    = CodeGenerator::codeGeneratorForPassword();

            $participant->setSalt(md5(uniqid()));

            // the 'security.password_encoder' service requires Symfony 2.6 or higher
            $encoder  = $this->container->get('security.password_encoder');
            $password = $encoder->encodePassword($participant, $passwordGen);
            $participant->setPassword($password);
            $this->getDoctrine()->getManager()->flush();
            $message = (new \Swift_Message('Reset mot de passe'))
                ->setFrom('no-reply@fanaf2019.org')
                ->setTo($participant->getEmail())
                ->setBody(
                    $this->renderView(
                    // templates/emails/registration.html.twig
                        'front/emails/reset.html.twig',
                        [
                            'name'     => $participant->getUsername(),
                            'password' => $passwordGen,

                        ]
                    ),
                    'text/html'
                )
                
            ;

            $mailer->send($message);
            $valid='Merci de vérifier que vous avez reçu un e-mail';
            return $this->render('security/reset.front.html.twig', array(
                'error' => $error,
                'valid' => $valid,
                'event'         => $event,
                'menus'         => $menus,
                'devises'             => $devises
            ));
        }

        return $this->render('security/reset.front.html.twig', array(
            'error' => $error,
            'event'         => $event,
            'valid' => $valid,
            'menus'         => $menus,
            'devises'             => $devises
        ));
    }
    /**
     * @Route("/login/modal", name="modal_login")
     */
    public function loginModal(Request $request)
    {
        $authUtils = $this->get('security.authentication_utils');
        // get the login error if there is one
        $error = $authUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authUtils->getLastUsername();

        return $this->render('front/login.modal_content.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }


}
