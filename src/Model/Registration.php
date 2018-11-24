<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 04/10/2018
 * Time: 18:30
 */

namespace App\Model;


use Doctrine\Common\Collections\ArrayCollection;

class Registration
{

    private $firstname;


    private $lastname;

    private $email;

    private $societe;

    private $poste;

    private $telephone;

    private $withHotel;
    private $withSupplement;


private $hotels;


    public function __construct()
    {
        //$this->hotels = new ArrayCollection();
    }


    /**
     * @return ArrayCollection
     */
    public function getHotels()
    {
        return $this->hotels;
    }

    /**
     * @param ArrayCollection $hotels
     */
    public function setHotels($hotels)
    {
        $this->hotels = $hotels;
    }



    /**
     * @return mixed
     */
    public function getWithSupplement()
    {
        return $this->withSupplement;
    }


    public function hasWithSupplement()
    {
        return $this->withSupplement;
    }

    /**
     * @param mixed $withSupplement
     */
    public function setWithSupplement($withSupplement)
    {
        $this->withSupplement = $withSupplement;
    }



    /**
     * @return mixed
     */
    public function hasWithHotel()
    {
        return $this->withHotel;
    }

    /**
     * @return mixed
     */
    public function getWithHotel()
    {
        return $this->withHotel;
    }

    /**
     * @param mixed $withHotel
     */
    public function setWithHotel($withHotel)
    {
        $this->withHotel = $withHotel;
    }





    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getSociete()
    {
        return $this->societe;
    }

    /**
     * @param mixed $societe
     */
    public function setSociete($societe)
    {
        $this->societe = $societe;
    }

    /**
     * @return mixed
     */
    public function getPoste()
    {
        return $this->poste;
    }

    /**
     * @param mixed $poste
     */
    public function setPoste($poste)
    {
        $this->poste = $poste;
    }

    /**
     * @return mixed
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param mixed $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

}