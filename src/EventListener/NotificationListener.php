<?php

namespace App\EventListener;

use App\Services\MailerManager;
use App\Event\BaseNotification;
use App\Event\NotificationEvent;
use App\Services\NotificationService;

/**
 * Created by PhpStorm.
 * Users: abc <abc@wevioo.com> , air <air@wevioo.com>
 * Date: 12/10/2016
 * Time: 11:03
 */
class NotificationListener
{

    private $notificationMailer;
    private $notificationService;
    private $accessor;



    public function __construct(MailerManager $notificationMailer, NotificationService $notificationService)
    {
        $this->notificationMailer = $notificationMailer;
        $this->notificationService = $notificationService;

    }


    /**
     * this function will prepare notification body by replacing all existing placeholders (found into %%)
     * by the correpondante value taken from data given by the NotificationEvent
     *
     * @param NotificationEvent $event
     */
    public function onNotify(NotificationEvent $event)
    {

        $baseNotificationsArray = $event->getBaseNotification()->getValues();
        foreach ($baseNotificationsArray as $baseNotification) {
            $this->doNotify($baseNotification);
        }
    }

    /**
     * This method make the notification
     * @param BaseNotification $baseNotification
     *
     */
    private function doNotify(BaseNotification $baseNotification)
    {
        if (null === $baseNotification) {
            return;
        }
        /// if contact array contain null value

        //looking for the notification type
//        $notification = $this->notificationService->findOneNotificationBy(
//            ['notificationType' => $baseNotification->getNotificationType()]
//        );
//
        $notification = $baseNotification->getNotification();

        if (null === $notification) {
            return;
        }

        //load message data
        $subject = $notification->getSubject();
        $message = $notification->getDescription();
        $contacts = $baseNotification->getContactList();
        if (!is_array($contacts)) {
            $contacts = array($contacts);
        }
        /*
         * Look for associated patterns
         */

        $notificationPatterns = $notification->getPattern()->getValues();
        if (!(count($notificationPatterns) >= 0)) {
            $this->notificationMailer->notify($contacts, $message, $subject); //send message without parsing content
            return;
        }

        /*
         * Explode notification Patterns to recipient and data Patterns
         */
        $explodedPatterns = $this->notificationMailer->extractPatterns($notificationPatterns);

        $dataPatterns = $explodedPatterns['data'];
        $dataCollection = $baseNotification->getData()->getValues();

        $message = $this->notificationMailer->replaceMessagePatterns($dataCollection, $message, $dataPatterns);

        $recipientPatterns = $explodedPatterns['recipient'];

        /*
         * Replace Recipient pattern by they ones
         */
        foreach ($contacts as $contact) {
            $messagetemp = $this->notificationMailer->replaceContactPatterns($contact, $message, $recipientPatterns);
            $this->notificationMailer->notify($contact, $messagetemp, $subject); //send message after replacing patterns
        }
        /*
         * End
         */
    }

}
