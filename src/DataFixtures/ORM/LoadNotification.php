<?php

namespace App\DataFixtures\ORM;


use App\DataFixtures\AbstractDataFixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Notification;
use App\Entity\Pattern;


/**
 * Description of LoadNotification
 *  Data Fixture
 * @author Aymen Amairia <aymen.amairia@wevioo.com>
 */
class LoadNotification extends AbstractDataFixture
{


    /**
     * @return array
     */
    public function getEnvironments()
    {
        return ['prod', 'test', 'dev'];
    }

    public function getOrder() {
        return 4;
    }

    /**
     * @param ObjectManager $manager
     */
    protected function doLoad(ObjectManager $manager) {


        //Array of default patterns
        $patterns = array(
            0 => array('propertyPath' => "recipient_gender", 'classPath' => '\App\Entity\Participant'),
            1 => array('propertyPath' => "recipient_firstname", 'classPath' => '\App\Entity\Participant'),
            2 => array('propertyPath' => "recipient_lastname", 'classPath' => '\App\Entity\Participant'),
            3 => array('propertyPath' => "recipient_username", 'classPath' => '\App\Entity\Participant'),
            5 => array('propertyPath' => "recipient_email", 'classPath' => '\App\Entity\Participant'),
            7 => array('propertyPath' => "participant_gender", 'classPath' => '\App\Entity\Participant'),
            8 => array('propertyPath' => "participant_firstname", 'classPath' => '\App\Entity\Participant'),
            9 => array('propertyPath' => "participant_lastname", 'classPath' => '\App\Entity\Participant'),
            10 => array('propertyPath' => "participant_username", 'classPath' => '\App\Entity\Participant'),

        		
        );
        //Persist Patterns
        foreach ($patterns as $key => $pattern_item) {

            $pattern = new Pattern();
            $pattern->setPropertyPath($pattern_item['propertyPath']);
            $pattern->setClassPath($pattern_item['classPath']);
            $manager->persist($pattern);
            $this->addReference('pattern_' . $key, $pattern);
        }
        // Flush Patterns in database must be independent
        $manager->flush();

        //Persist Notifications
        for ($notificationType = 0; $notificationType < 61; $notificationType++) {

            $notification_item = $this->getNotificationByType($notificationType);

            if (is_null($notification_item)) {
                continue;
            }

            $notification = new Notification();
            $notification->setSubject($notification_item['title']);
            $notification->setDescription($notification_item['description']);
            $notification->setNotificationType($notificationType);


            foreach ($notification_item['associatedPatterns'] as $propertyPath) {
                $pattern = $manager->getRepository("App:Pattern")->findOneByPropertyPath($propertyPath);
                if (null !== $pattern) {
                    $notification->addPattern($pattern);
                }
            }
            $manager->persist($notification);
            $this->addReference('notification_' . ($notificationType), $notification);
        }
        // Flush Notifications in database must be independent
        $manager->flush();
    }

    /**
     * This function returns notification by its type
     * @param String $notificationType Notification Type
     * @return array $notification
     */
    public function getNotificationByType($notificationType) {

        $notification = array(
            'title' => '',
            'description' => '',
            'notificationType' => $notificationType,
            'associatedPatterns' => array("recipient_gender", "recipient_firstname", "recipient_lastname"), //default assioted patterns could be overrided
        );
        switch ($notificationType) {
            case 1 :
                $notification['title'] = "Inscription destiné aux administrateurs";
                $notification['description'] .= "Bonjour,";
                $notification['description'] .= "<br />";
                $notification['description'] .= "L’utilisateur %participant_gender% %participant_lastname% %participant_firstname% a été créé";
                array_push($notification['associatedPatterns'], "participant_gender", "participant_firstname", "participant_lastname");
                break;
            case 2 :
                $notification['title'] = "Bienvenue";
                $notification['description'] .= "Cher(e) %recipient_gender% %recipient_lastname% %recipient_firstname%,";
                $notification['description'] .= "<br />";
                $notification['description'] .= "Merci pour votre intérêt pour [Métier : CONF 2018], nous vous souhaitons la bienvenue.";
                array_push($notification['associatedPatterns'], "participant_gender", "participant_firstname", "participant_lastname");
                break;
            case 3 :
                $notification['title'] = "Inscription associé destiné aux administrateurs";
                $notification['description'] .= "Bonjour,";
                $notification['description'] .= "<br />";
                $notification['description'] .= "L’utilisateur %participant_gender% %participant_lastname% %participant_firstname% a été associé à l’application métier CONF 2018";
                array_push($notification['associatedPatterns'], "participant_gender", "participant_firstname", "participant_lastname");
                break;
            default:
                $notification = null;
                break;
        }

        return $notification;
    }

}
