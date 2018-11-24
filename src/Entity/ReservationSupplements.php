<?php

namespace App\Entity;

use App\Traits\BaseEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * ReservationSupplements
 *
 * @ORM\Table(name="reservations_supplements")
 * @ORM\Entity(repositoryClass="App\Repository\ReservationSupplementsRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class ReservationSupplements
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
     * @ORM\Column(name="montant", type="float", nullable=false)
     */
    private $total;


    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Supplement", inversedBy="reservationSupplements")
     */
    private $supplements;

    /**
     * @var \App\Entity\Reservation
     *
     * @ORM\ManyToOne(targetEntity="Reservation", cascade={"persist"}, inversedBy="reservationsSupplements")
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
        $this->supplements = new ArrayCollection();
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

    /**
     * @return Collection|Supplement[]
     */
    public function getSupplements(): Collection
    {
        return $this->supplements;
    }

    public function addSupplement(Supplement $supplement): self
    {
        if (!$this->supplements->contains($supplement)) {
            $this->supplements[] = $supplement;
        }

        return $this;
    }

    public function removeSupplement(Supplement $supplement): self
    {
        if ($this->supplements->contains($supplement)) {
            $this->supplements->removeElement($supplement);
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


}
