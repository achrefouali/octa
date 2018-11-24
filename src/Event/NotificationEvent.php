<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 06/09/2016
 * Time: 09:20
 */
namespace App\Event;


use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\EventDispatcher\Event;

class NotificationEvent extends Event {

    /*
     * List of base notifications
     * */
    private $baseNotification;


    public function __construct()
    {
        $this->baseNotification = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getBaseNotification()
    {
        return $this->baseNotification;
    }


    /**
     * @param $baseNotification
     * @return $this
     */
    public function addBaseNotification($baseNotification){
        $this->baseNotification->add($baseNotification);
        return $this;
    }

}