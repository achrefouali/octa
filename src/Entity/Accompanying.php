<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AccompanyingRepository")
 */
class Accompanying
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firtname;

    /**
     * @ORM\Column(type="integer")
     */
    private $type;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirtname(): ?string
    {
        return $this->firtname;
    }

    public function setFirtname(string $firtname): self
    {
        $this->firtname = $firtname;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @var \App\Entity\ReservationEvent
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\ReservationEvent")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Reservation_event_id", referencedColumnName="id", nullable=false)
     * })
     *
     */
    private $reservationEvent;

   public function getReservationEvent()
    {
        return $this->reservationEvent;
    }

    public function setReservationEvent(ReservationEvent $reservationEvent): self
    {
        $this->reservationEvent = $reservationEvent;

        return $this;
    }

    public function getFormattedType(){
        switch ($this->type){
            case 0 : return('Parent');
            case 1 : return('Epouse');
            case 2 : return('Enfant');
        }
    }




 
}
