<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * HotelReservationPackage
 *
 * @ORM\Table(name="hotel_reservation_package")
 * @ORM\Entity(repositoryClass="App\Repository\HotelReservationPackageRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class HotelReservationPackage
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ReservationHotel", inversedBy="hotelReservationsPackage")
     * @ORM\JoinColumn(name="reservation_hotel_id", referencedColumnName="id")
     */
    private $reservationHotel;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\HotelPackage", inversedBy="hotelReservationsPackage")
     * @ORM\JoinColumn(name="hotel_package_id", referencedColumnName="id")
     */
    private $package;

    /**
     * @var string
     *
     * @ORM\Column(name="quantity", type="integer", nullable=false)
     */
    private $quantity;

    public function __toString()
    {
        return 'HotelReservationPackage ID : '.$this->getId();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getReservationHotel(): ?ReservationHotel
    {
        return $this->reservationHotel;
    }

    public function setReservationHotel(?ReservationHotel $reservationHotel): self
    {
        $this->reservationHotel = $reservationHotel;

        return $this;
    }

    public function getPackage(): ?HotelPackage
    {
        return $this->package;
    }

    public function setPackage(?HotelPackage $package): self
    {
        $this->package = $package;

        return $this;
    }




}
