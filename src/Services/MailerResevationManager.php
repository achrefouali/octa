<?php
/**
 * Created by PhpStorm.
 * User: acf
 * Date: 19/11/2018
 * Time: 10:42
 */

namespace App\Services;


use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessor;

class MailerResevationManager
{
    private $fromName = 'no-reply';
    private $fromAdress = 'no-reply@auf.org';
    private $mailer;
    private $container;
    private $accessor;


    public function __construct($mailer)
    {

        $this->mailer = $mailer;
        $this->accessor = PropertyAccess::createPropertyAccessor();
    }

    public function sendMessageConfirmation(array $contacts, $subject = '', $event, array $attachs = null)
    {

        if (array_key_exists('mail',$contacts)) {
            $contacts = array($contacts);
        }
        foreach ($contacts as $contact) {



            $message = (new \Swift_Message())
                ->setSubject($subject)
                ->setFrom(array($this->fromAdress => $this->fromName))
                // set the destination mailer, and if is defined add the destination name..The mail will be used as name else.
                ->setTo($contact['mail'],isset($contact['name'])?$contact['name']:$contact['mail']);
            if($attachs != null && count($attachs)>0){
                foreach ($attachs as $attach) {
                    $message->attach(new \Swift_Attachment(
                        $attach
                    ));
                }
            }

            $this->mailer->send($message);
        }
    }


    public function sendMessageconfirmationPaiement(array $contacts, $subject = '', $event, array $attachs = null)
    {

        if (array_key_exists('mail',$contacts)) {
            $contacts = array($contacts);
        }
        foreach ($contacts as $contact) {
            $message = (new \Swift_Message())
                ->setSubject($subject)
                ->setFrom(array($this->fromAdress => $this->fromName))
                // set the destination mailer, and if is defined add the destination name..The mail will be used as name else.
                ->setTo($contact['mail'],isset($contact['name'])?$contact['name']:$contact['mail']);

            if($attachs != null && count($attachs)>0){
                foreach ($attachs as $attach) {
                    $message->attach(new \Swift_Attachment(
                        $attach,
                        'recu.pdf',
                        'application/pdf'
                    ));
                }
            }
            $this->mailer->send($message);
        }
    }



    /**
     * SetContainer
     * @param ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
    }



}