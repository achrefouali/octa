<?php

namespace App\Entity;

use App\Traits\BaseEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Hotel
 *
 * @ORM\Table(name="hotels")
 * @ORM\Entity(repositoryClass="App\Repository\HotelRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Hotel
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
     * @var string
     *
     * @ORM\Column(name="designation", type="string", length=255, nullable=false)
     */
    private $designation;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="services", type="text", nullable=true)
     */
    private $services;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=100, nullable=true)
     */
    private $adresse;


    /**
     * @var \Ville
     *
     * @ORM\ManyToOne(targetEntity="Ville", inversedBy="hotels")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ville_id", referencedColumnName="id", nullable=false)
     * })
     *
     */
    private $ville;


    /**
     * @var string
     *
     * @ORM\Column(name="categorie", type="string", nullable=false)
     */
    private $categorie;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\HotelImage", mappedBy="hotel", cascade={"remove","persist"})
     */
    private $pictures;


    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="string", length=255, nullable=true)
     */
    private $longitude;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="string", length=255, nullable=true)
     */
    private $latitude;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\HotelPackage", mappedBy="hotel", cascade={"remove","persist"})
     */
    private $packages;

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
     * Constructor
     */
    public function __construct()
    {
        $this->pictures = new \Doctrine\Common\Collections\ArrayCollection();
        $this->categorie = 0;
        $this->packages = new ArrayCollection();
    }

    /**
     * Set designation
     *
     * @param string $designation
     * @return Hotel
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
     * Set description
     *
     * @param string $description
     * @return Hotel
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set services
     *
     * @param string $services
     * @return Hotel
     */
    public function setServices($services)
    {
        $this->services = $services;

        return $this;
    }

    /**
     * Get services
     *
     * @return string 
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     * @return Hotel
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string 
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     * @return Hotel
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string 
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     * @return Hotel
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string 
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set ville
     *
     * @param \App\Entity\Ville $ville
     * @return Hotel
     */
    public function setVille(\App\Entity\Ville $ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return \App\Entity\Ville
     */
    public function getVille()
    {
        return $this->ville;
    }



    /**
     * Add pictures
     *
     * @param \App\Entity\HotelImage $pictures
     * @return Hotel
     */
    public function addPicture(\App\Entity\HotelImage $pictures)
    {
        $this->pictures[] = $pictures;

        return $this;
    }

    /**
     * Remove pictures
     *
     * @param \App\Entity\HotelImage $pictures
     */
    public function removePicture(\App\Entity\HotelImage $pictures)
    {
        $this->pictures->removeElement($pictures);
    }

    /**
     * Get pictures
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPictures()
    {
        return $this->pictures;
    }

    /**
     * Add packages
     *
     * @param \App\Entity\HotelPackage $packages
     * @return Hotel
     */
    public function addPackage(\App\Entity\HotelPackage $packages)
    {
        $this->packages[] = $packages;

        return $this;
    }

    /**
     * Remove packages
     *
     * @param \App\Entity\HotelPackage $packages
     */
    public function removePackage(\App\Entity\HotelPackage $packages)
    {
        $this->packages->removeElement($packages);
    }

    /**
     * Get packages
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPackages()
    {
        return $this->packages;
    }

    public function getMinimumPrice(){
        $price = 0;
        if(!empty($this->packages)){

            foreach ($this->packages as $package){

                //$price =

            }
        }
     return $price;
    }

    /**
     * Set categorie
     *
     * @param integer $categorie
     * @return Hotel
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return integer 
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    public function __toString(): ?String
    {
        return (string) $this->getDesignation();
    }


}
