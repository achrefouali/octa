<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 20/10/2016
 * Time: 10:10
 */

namespace App\Event;

use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Notification;

class BaseNotification
{

    /*
     * List of users to contact
     * */
    private $contactList;
    /*
      * ArrayCollection containing data to display notifications template
      * */
    private $data;
    /**
     * @var int $notificationType
     */
    private $notificationType;
    /*
     * other options
     * */
    private $options = array();


    /**
     * BaseNotification constructor.
     * Instantiating this class request providing a notification type and listof users to notify
     *
     * @param $notification App\Entity\Notification
     * @param array $users simple or multiple users
     */
    public function __construct(Notification $notification, array $users)
    {
        $this->contactList = $users;
        $this->notification = $notification;
        $this->data = new ArrayCollection();
    }

    /**
     * Get the list of contacts
     * @return ArrayCollection $contactList
     */
    public function getContactList()
    {
        return $this->contactList;
    }


    /**
     * @param $contactList
     * @return $this
     */
    public function setContactList($contactList)
    {
        $this->contactList = $contactList;

    }


    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param array $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }

    /**
     * @return mixed
     */
    public function getNotification()
    {
        return $this->notification;
    }

    /**
     * @param $notification
     * @return $this
     */
    public function setNotification($notification)
    {
        $this->notification = $notification;
        return $this;
    }

    /** getData
     * @return ArrayCollection
     */
    public function getData()
    {
        return $this->data;
    }


    /** addData
     * @param $dataValue
     * @param string $askedPrefix
     * @return $this
     */
    public function addData($dataValue, $askedPrefix = '')
    {
    	if(!empty($askedPrefix))
        	$this->data->add(['data'=>$dataValue, 'askedPrefix'=> $askedPrefix]);
        else 
        	$this->data->add($dataValue);
        
        return $this;
    }


}