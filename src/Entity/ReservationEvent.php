<?php

namespace App\Entity;

use App\Traits\BaseEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * ReservationEvent
 *
 * @ORM\Table(name="reservations_event")
 * @ORM\Entity(repositoryClass="App\Repository\ReservationEventRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class ReservationEvent
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
     * @var int
     *
     * @ORM\Column(name="tarif_id", type="integer", nullable=true)
     */
    private $tarifId;

    public function getTarifId(){
        return $this->tarifId;
    }
    public function setTarifId($tarifId){
        $this->tarifId= $tarifId;
        return $this;
    }
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Event")
     * @ORM\JoinColumn(name="event_id", referencedColumnName="id")
     */
    private $event;

    /**
     * @var \App\Entity\Reservation
     *
     * @ORM\ManyToOne(targetEntity="Reservation", cascade={"persist"}, inversedBy="reservationsEvents")
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

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): self
    {
        $this->event = $event;

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

/**
 * @var string
 *
 * @ORM\Column(name="devisAcco", type="string", length=255, nullable=true)
 */
    private $devisAcco;

    /**
     * @var \App\Entity\Hotel
     *
     * @ORM\ManyToOne(targetEntity="Hotel", cascade={"persist"} )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="hotel_id", referencedColumnName="id", nullable=true)
     * })
     *
     */
    private $hotel;

  public function getHotel()
{
    return $this->hotel;
}

    public function setHotel($hotel)
{
    $this->hotel = $hotel;

    return $this;
}


  public function getDevis()
{
    return $this->devis;
}

    public function setDevis($devis)
{
    $this->devis = $devis;

    return $this;
}

  public function getDevisAcco()
{
    return $this->devisAcco;
}

    public function setDevisAcco($devisAcco)
{
    $this->devisAcco = $devisAcco;

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

public function getFormattedCurrency(){
    switch($this->currency){
        case 0: return ('Dinars');
        case 1: return ('Euros');
        case 2: return ('Dollars');
       

    }
}
}


