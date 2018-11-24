<?php

namespace App\Entity;

use App\Traits\BaseEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="supplements")
 * @ORM\Entity(repositoryClass="App\Repository\SupplementRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Supplement
{

    use BaseEntity;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $designation;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lieu;


    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ReservationSupplements", mappedBy="supplements")
     */
    private $reservationSupplements;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Event", inversedBy="supplements")
     * @ORM\JoinColumn(name="event_id", referencedColumnName="id")
     */
    private $event;

    public function __construct()
    {
        $this->reservationSupplements = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getReservationEvent(): ?ReservationSupplements
    {
        return $this->reservationEvent;
    }

    public function setReservationEvent(?ReservationSupplements $reservationEvent): self
    {
        $this->reservationEvent = $reservationEvent;

        return $this;
    }

    /**
     * @return Collection|ReservationSupplements[]
     */
    public function getReservationSupplements(): Collection
    {
        return $this->reservationSupplements;
    }

    public function addReservationSupplement(ReservationSupplements $reservationSupplement): self
    {
        if (!$this->reservationSupplements->contains($reservationSupplement)) {
            $this->reservationSupplements[] = $reservationSupplement;
            $reservationSupplement->addSupplement($this);
        }

        return $this;
    }

    public function removeReservationSupplement(ReservationSupplements $reservationSupplement): self
    {
        if ($this->reservationSupplements->contains($reservationSupplement)) {
            $this->reservationSupplements->removeElement($reservationSupplement);
            $reservationSupplement->removeSupplement($this);
        }

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


    public function __toString(){
        return (string) $this->getDesignation();
    }

}
