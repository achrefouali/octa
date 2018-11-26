<?php

namespace App\Entity;

use App\Traits\BaseEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * ReservationHotel
 *
 * @ORM\Table(name="reservations_hotel")
 * @ORM\Entity(repositoryClass="App\Repository\ReservationHotelRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class ReservationHotel
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
     * @ORM\Column(name="total", type="float", nullable=false)
     */
    private $total;


    /**
     * @var string
     *
     * @ORM\Column(name="nb_jours", type="integer", nullable=false)
     */
    private $nbJours;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $dateDebut;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime" , nullable=true)
     */
    private $dateFin;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Hotel")
     * @ORM\JoinColumn(name="hotel_id", referencedColumnName="id")
     */
    private $hotel;

    /**
     * Many Reservations have Many Packages.
     * @ORM\OneToMany(targetEntity="App\Entity\HotelReservationPackage", mappedBy="package")
     */
    private $hotelReservationsPackage;

    /**
     * @var \App\Entity\Reservation
     *
     * @ORM\ManyToOne(targetEntity="Reservation", cascade={"persist"}, inversedBy="reservationsHotels")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="reservation_id", referencedColumnName="id")
     * })
     */
    private $reservation;


    /**
     * @var string
     *
     * @ORM\Column(name="payment_method", type="integer", nullable=false)
     */
    private $paymentMethod;

    public function __construct()
    {
        $this->hotelReservationsPackage = new ArrayCollection();
    }


    /**
     * @var string
     *
     * @ORM\Column(name="receivedAmout", type="float", nullable=true)
     */
    private $receivedAmout;

    public function getReceivedAmout(){
        return $this->receivedAmout;
    }
    public function setReceivedAmout($receivedAmout){
        $this->receivedAmout = $receivedAmout;
        return $this;
    }

    public function __toString()
    {
        return (string) 'ID:'.$this->id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(float $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getNbJours(): ?int
    {
        return $this->nbJours;
    }

    public function setNbJours(int $nbJours): self
    {
        $this->nbJours = $nbJours;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(?\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getHotel(): ?Hotel
    {
        return $this->hotel;
    }

    public function setHotel(?Hotel $hotel): self
    {
        $this->hotel = $hotel;

        return $this;
    }

    /**
     * @return Collection|HotelReservationPackage[]
     */
    public function getHotelReservationsPackage(): Collection
    {
        return $this->hotelReservationsPackage;
    }

    public function addHotelReservationsPackage(HotelReservationPackage $hotelReservationsPackage): self
    {
        if (!$this->hotelReservationsPackage->contains($hotelReservationsPackage)) {
            $this->hotelReservationsPackage[] = $hotelReservationsPackage;
        }

        return $this;
    }

    public function removeHotelReservationsPackage(HotelReservationPackage $hotelReservationsPackage): self
    {
        if ($this->hotelReservationsPackage->contains($hotelReservationsPackage)) {
            $this->hotelReservationsPackage->removeElement($hotelReservationsPackage);
        }

        return $this;
    }

    public function getReservation(): ?Reservation
    {
        return $this->reservation;
    }

    public function setReservation(?Reservation $reservation): self
    {
        $this->reservation = $reservation;

        return $this;
    }

    public function getPaymentMethod(): ?int
    {
        return $this->paymentMethod;
    }

    public function setPaymentMethod(int $paymentMethod): self
    {
        $this->paymentMethod = $paymentMethod;

        return $this;
    }


    /**
     * @var string
     *
     * @ORM\Column(name="devis", type="string", length=255, nullable=true)
     */
    private $devis;
  public function getDevis()
{
    return $this->devis;
}

    public function setDevis($devis)
{
    $this->devis = $devis;

    return $this;
}


    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=50, nullable=true)
     *
     */
    private $code;

public function getCode(){
    return $this->code;
}
public function setCode($code){
    $this->code = $code;
    return $this ;
}


/**
 * @var integer
 *
 * @ORM\Column(name="paiementType",type="integer", nullable=true)
 */
    private $paiementType;

/**
 *
 *
 * @ORM\Column(name="obsPaiement",type="text", length=1000 ,nullable=true)
 */
    private $obsPaiement;

/**
 * @var \DateTime
 * @ORM\Column(type="datetime", nullable=true)
 */
    private $datePaiement;

/**
 * @var string
 * @ORM\Column(type="string", length=255 , nullable=true)
 */
    private $operator;



    public function getPaiementType()
{
    return $this->paiementType;
}

    public function setPaiementType( $paiementType)
{
    $this->paiementType = $paiementType;

    return $this;
}

    public function getObsPaiement()
{
    return $this->obsPaiement;
}

    public function setObsPaiement( $obsPaiement)
{
    $this->obsPaiement = $obsPaiement;

    return $this;
}


    public function getDatePaiement()
{
    return $this->datePaiement;
}

    public function setDatePaiement( $datePaiement)
{
    $this->datePaiement = $datePaiement;

    return $this;
}


    public function getOperator()
{
    return $this->operator;
}

    public function setOperator( $operator)
{
    $this->operator = $operator;

    return $this;
}
public function getFormattedPaiementType(){
    switch($this->paiementType){
        case 0: return ('Carte Bancaire');
        case 1: return ('Virement');
        case 2: return ('Chéque bancaire');
        case 3: return ('Bon de commande');
        case 4: return ('Liquide');

    }
}

/**
 * @var integer
 *
 * @ORM\Column(name="currency",type="integer", nullable=true)
 */
    private $currency;
   public function getCurrency()
{
    return $this->currency;
}

    public function setCurrency( $currency)
{
    $this->currency = $currency;

    return $this;
}
public function getFormattedCurrency(){
    switch($this->currency){
        case 0: return ('Dinars');
        case 1: return ('Euros');
        case 2: return ('Dollars');


    }
}

}
