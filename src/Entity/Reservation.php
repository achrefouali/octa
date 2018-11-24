<?php

namespace App\Entity;

use App\Traits\BaseEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * Reservation
 *
 * @ORM\Table(name="reservations")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Reservation
{

    use BaseEntity;
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=50, nullable=false, options={"default":"Waiting"})
     */
    private $state;

    /**
     * @var float
     *
     * @ORM\Column(name="totalPrice",type="float", scale=2, nullable=false)
     */
    private $totalPrice;



    /**
     * @var string
     *
     * @ORM\Column(name="devis", type="string", length=255, nullable=true)
     */
    private $devis;

    /**
     * @var string
     *
     * @ORM\Column(name="reservation_ref", type="string", length=50, nullable=true)
     */
    private $reservationRef;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Participant", inversedBy="reservations")
     */
    private $participant;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ReservationEvent", mappedBy="reservation", cascade={"remove","persist"})
     */
    private $reservationsEvents;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ReservationHotel", mappedBy="reservation", cascade={"remove","persist"})
     */
    private $reservationsHotels;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ReservationSupplements", mappedBy="reservation", cascade={"remove","persist"})
     */
    private $reservationsSupplements;
    /**
     * @ORM\Column(type="integer",nullable=true )
     */
    private $nbAccompanying;

    public function getNbAccompanying(){
        return $this->nbAccompanying;
    }

    public function setNbAccompanying($nbAccompanying){
        $this->nbAccompanying = $nbAccompanying;

        return $this;
    }

    /**
     * @ORM\Column(type="time",nullable=true )
     */
    private $heureArrival;

    public function getHeureArrival()
    {
        return $this->heureArrival;
    }

    public function setHeureArrival($heureArrival)
    {
        $this->heureArrival = $heureArrival;

        return $this;
    }
    /**
     * @ORM\Column(type="time",nullable=true )
     */
    private $heureDeparture;

    public function getHeureDeparture()
    {
        return $this->heureDeparture;
    }

    public function setHeureDeparture($heureDeparture)
    {
        $this->heureDeparture = $heureDeparture;

        return $this;
    }
    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateArrive;

    public function getDateArrive()
    {
        return $this->dateArrive;
    }

public function setDateArrive( $dateArrive)
    {
        $this->dateArrive = $dateArrive;

        return $this;
    }


    /**
     * @var \DateTime
     * @ORM\Column(type="datetime" , nullable=true)
     */
    private $dateDepart;
    public function getDateDepart()
    {
        return $this->dateDepart;
    }

    public function setDateDepart( $dateDepart)
    {
        $this->dateDepart = $dateDepart;

        return $this;
    }
    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $numVolArrive;

    public function getNumVolArrive()
    {
        return $this->numVolArrive;
    }

    public function setNumVolArrive( $numVolArrive)
{
    $this->numVolArrive = $numVolArrive;

    return $this;
}

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $numVolDepart;

    public function getNumVolDepart(): ?string
    {
        return $this->numVolDepart;
    }

    public function setNumVolDepart(string $numVolDepart): self
{
    $this->numVolDepart = $numVolDepart;

    return $this;
}

    public function __construct()
    {
        $this->state = 0 ;
        $this->reservationsEvents = new ArrayCollection();
        $this->reservationsHotels = new ArrayCollection();
        $this->reservationsSupplements = new ArrayCollection();
        $this->accompanying = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getTotalPrice(): ?float
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(float $totalPrice): self
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }



    public function getReservationRef(): ?string
    {
        return $this->reservationRef;
    }

    public function setReservationRef(?string $reservationRef): self
    {
        $this->reservationRef = $reservationRef;

        return $this;
    }

    public function getParticipant(): ?Participant
    {
        return $this->participant;
    }

    public function setParticipant(?Participant $participant): self
    {
        $this->participant = $participant;

        return $this;
    }

    /**
     * @return Collection|ReservationHotel[]
     */
    public function getReservationsHotels(): Collection
    {
        return $this->reservationsHotels;
    }

    public function addReservationsHotel(ReservationHotel $reservationsHotel): self
    {
        if (!$this->reservationsHotels->contains($reservationsHotel)) {
            $this->reservationsHotels[] = $reservationsHotel;
            $reservationsHotel->setReservation($this);
        }

        return $this;
    }

    public function removeReservationsHotel(ReservationHotel $reservationsHotel): self
    {
        if ($this->reservationsHotels->contains($reservationsHotel)) {
            $this->reservationsHotels->removeElement($reservationsHotel);
            // set the owning side to null (unless already changed)
            if ($reservationsHotel->getReservation() === $this) {
                $reservationsHotel->setReservation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ReservationSupplements[]
     */
    public function getReservationsSupplements(): Collection
    {
        return $this->reservationsSupplements;
    }

    public function addReservationsSupplement(ReservationSupplements $reservationsSupplement): self
    {
        if (!$this->reservationsSupplements->contains($reservationsSupplement)) {
            $this->reservationsSupplements[] = $reservationsSupplement;
            $reservationsSupplement->setReservation($this);
        }

        return $this;
    }

    public function removeReservationsSupplement(ReservationSupplements $reservationsSupplement): self
    {
        if ($this->reservationsSupplements->contains($reservationsSupplement)) {
            $this->reservationsSupplements->removeElement($reservationsSupplement);
            // set the owning side to null (unless already changed)
            if ($reservationsSupplement->getReservation() === $this) {
                $reservationsSupplement->setReservation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ReservationEvent[]
     */
    public function getReservationsEvents(): Collection
    {
        return $this->reservationsEvents;
    }

    public function addReservationsEvent(ReservationEvent $reservationsEvent): self
    {
        if (!$this->reservationsEvents->contains($reservationsEvent)) {
            $this->reservationsEvents[] = $reservationsEvent;
            $reservationsEvent->setReservation($this);
        }

        return $this;
    }

    public function removeReservationsEvent(ReservationEvent $reservationsEvent): self
    {
        if ($this->reservationsEvents->contains($reservationsEvent)) {
            $this->reservationsEvents->removeElement($reservationsEvent);
            // set the owning side to null (unless already changed)
            if ($reservationsEvent->getReservation() === $this) {
                $reservationsEvent->setReservation(null);
            }
        }

        return $this;
    }


    public function __toString(){
        return (string) $this->getReservationRef();
    }


    public function getFormattedState()
{
    switch ($this->state) {
        case 0:
            return ('En attente');
        case 1:
            return ('Accepté et payé');
        case 2:
            return ('Accepté et non payé');
        case 3:
            return ('Annulé par le client');
        case 4:
            return ('Annulé par l\'Agence');
        case 5:
            return ('Paiement échoué');
        case 6:
            return ('Accepté et totalement payé');
        case 7:
            return ('Paiement refuser par la banque');
        case 8:
            return ('Offre');
        case 9:
            return ('Paiement annulé');
    }
}

/**
 * @ORM\OneToMany(targetEntity="App\Entity\Accompanying", mappedBy="reservation", cascade={"remove","persist"})
 */
    private $accompanying;



    /**
     * @return Collection|Accompanying[]
     */
    public function getAccompanying()
{
    return $this->accompanying;
}
//
    public function addAccompanying(Accompanying $accompanying)
{
    if (!$this->accompanying->contains($accompanying)) {
        $this->accompanying[] = $accompanying;
        $accompanying->setReservation($this);
    }

    return $this;
}

    public function removeAccompanying(Accompanying $accompanying): self
{
    if ($this->accompanying->contains($accompanying)) {
        $this->accompanying->removeElement($accompanying);
        // set the owning side to null (unless already changed)
        if ($accompanying->getReservation() === $this) {
            $accompanying->setReservation($this);
        }
    }

    return $this;
}






}
