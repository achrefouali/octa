<?php

namespace App\Entity;

use App\Traits\BaseEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * HotelPackagePeriode
 *
 * @ORM\Table(name="hotel_package_periode")
 * @ORM\Entity(repositoryClass="App\Repository\HotelPackagePeriodeRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class HotelPackagePeriode
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
     * @ORM\ManyToOne(targetEntity="App\Entity\HotelPackage", inversedBy="periodes")
     * @ORM\JoinColumn(name="package_id", referencedColumnName="id")
     */
    private $package;

    /**
     * @var string
     *
     * @ORM\Column(name="prix_achat", type="float", nullable=false)
     */
    private $prixAchat;


    /**
     * @var string
     *
     * @ORM\Column(name="comission", type="float", nullable=false)
     */
    private $commision;


    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    private $dateDebut;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    private $dateFin;

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
     * Set prixAchat
     *
     * @param float $prixAchat
     * @return HotelPackagePeriode
     */
    public function setPrixAchat($prixAchat)
    {
        $this->prixAchat = $prixAchat;

        return $this;
    }

    /**
     * Get prixAchat
     *
     * @return float 
     */
    public function getPrixAchat()
    {
        return $this->prixAchat;
    }

    /**
     * Set commision
     *
     * @param float $commision
     * @return HotelPackagePeriode
     */
    public function setCommision($commision)
    {
        $this->commision = $commision;

        return $this;
    }

    /**
     * Get commision
     *
     * @return float 
     */
    public function getCommision()
    {
        return $this->commision;
    }

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     * @return HotelPackagePeriode
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime 
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     * @return HotelPackagePeriode
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime 
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set package
     *
     * @param \App\Entity\HotelPackage $package
     * @return HotelPackagePeriode
     */
    public function setPackage(\App\Entity\HotelPackage $package = null)
    {
        $this->package = $package;

        return $this;
    }

    /**
     * Get package
     *
     * @return \App\Entity\HotelPackage 
     */
    public function getPackage()
    {
        return $this->package;
    }
}
