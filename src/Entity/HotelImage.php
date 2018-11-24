<?php

namespace App\Entity;

use App\Traits\BaseEntity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * HotelImage
 *
 * @ORM\Table(name="hotel_images")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class HotelImage
{

    use BaseEntity;
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;



    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Hotel", inversedBy="pictures")
     * @ORM\JoinColumn(name="hotel_id", referencedColumnName="id")
     */
    private $hotel;


    /**
     * @var boolean
     *
     * @ORM\Column(name="main", type="boolean", nullable=false)
     */
    private $main = false;

    /**
     * @var string
     *
     * @ORM\Column(name="designation", type="string", length=255, nullable=false)
     */
    private $designation;

    /**
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank(message="Please, upload the hotel picture as an Image file.")
     * @Assert\Image()
     */
    private $picture;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return bool
     */
    public function isMain() {
        return $this->main;
    }


    /**
     * Set picture
     *
     * @param string $picture
     *
     * @return User
     */
    public function setPicture($picture) {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return string
     */
    public function getPicture() {
        return $this->picture;
    }



    /**
     * Set main
     *
     * @param boolean $main
     * @return HotelImage
     */
    public function setMain($main)
    {
        $this->main = $main;

        return $this;
    }

    /**
     * Get main
     *
     * @return boolean 
     */
    public function getMain()
    {
        return $this->main;
    }

    /**
     * Set designation
     *
     * @param string $designation
     * @return HotelImage
     */
    public function setDesignation($designation)
    {
        $this->designation = $designation;

        return $this;
    }

    /**
     * Get designation
     *
     * @return string 
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * Set hotel
     *
     * @param \App\Entity\Hotel $hotel
     * @return HotelImage
     */
    public function setHotel(\App\Entity\Hotel $hotel = null)
    {
        $this->hotel = $hotel;

        return $this;
    }

    /**
     * Get hotel
     *
     * @return \App\Entity\Hotel 
     */
    public function getHotel()
    {
        return $this->hotel;
    }
}
