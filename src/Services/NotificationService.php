<?php

namespace App\Services;


use App\Entity\Notification;
use App\Services\CrudService;
use Doctrine\ORM\EntityManager;


/**
 * Description of NotificationService
 *
 * @author air
 */
class NotificationService
{

    private $application_crud;
    private $em;

    /**
     * Construct
     * @param EntityManager $em
     * @param CrudService $application_crud
     */
    public function __construct(EntityManager $em, CrudService $application_crud)
    {

        $this->em = $em;
        $this->application_crud = $application_crud;
    }

    /**
     * Function get List notifications  with options
     * @param array | $filter filter with options
     * @return mixed
     */
    public function getNotifications($filter = array('enabled' => 1), $paginator = false)
    {
        return $this->em->getRepository('App:Notification')
            ->findRecordsByFilter(
                $filter, 
                $this->application_crud->getSortColumn('application_notification_sort'), 
                $this->application_crud->getSortOrder('application_notification_sort_orderBy'),
                $paginator
            );
    }

    /**
     * Function add new notification
     * @param $notification
     * @return $notification
     */
    public function addNotification($notification)
    {


        $this->em->persist($notification);
        $this->em->flush();
        return $notification;
    }

    /**
     * @param array $criteria
     * @return Notification
     */
    public function findOneNotificationBy(array $criteria)
    {

        return $this->em->getRepository('App:Notification')->findOneBy(
            $criteria
        );
    }


    public function __call($name, $arguments)
    {
        //  the number of crud service's methods' arguments should be internally handled
        return $this->application_crud->$name($arguments);
    }


}
