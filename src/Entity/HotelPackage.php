<?php

namespace App\Entity;

use App\Traits\BaseEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * HotelPackage
 *
 * @ORM\Table(name="hotel_package")
 * @ORM\Entity(repositoryClass="App\Repository\HotelPackageRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class HotelPackage
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Hotel", inversedBy="packages")
     * @ORM\JoinColumn(name="hotel_id", referencedColumnName="id")
     */
    private $hotel;

    /**
     * @var string
     *
     * @ORM\Column(name="designation", type="string", length=255, nullable=false)
     */
    private $designation;


    /**
     * @var string
     *
     * @ORM\Column(name="nb_personnes", type="integer", nullable=false)
     */
    private $nbPersonnes;




    /**
     * @ORM\OneToMany(targetEntity="App\Entity\HotelPackagePeriode", mappedBy="package", cascade={"remove","persist"})
     */
    private $periodes;

    /**
     * Many Reservations have Many Packages.
     * @ORM\OneToMany(targetEntity="App\Entity\HotelReservationPackage", mappedBy="package")
     */
    private $hotelReservationsPackage;

    /**
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank(message="Please, upload the Hotel Package picture as an Image file.")
     * @Assert\Image(
     *     maxSize = "1024k",
     *     mimeTypesMessage = "Please upload a valid Picture"
     * )
     */
    private $picture;


    /**
     * Many Reservations have Many Packages.
     * @ORM\OneToMany(targetEntity="App\Entity\HotelReservationPackage", mappedBy="package")
     */
    private $reservationsHotels;

    public function __construct()
    {
        $this->periodes = new ArrayCollection();
        $this->hotelReservationsPackage = new ArrayCollection();
        $this->reservationsHotels = new ArrayCollection();
    }



    public function __toString()
    {
        return (string) $this->getDesignation();
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

    public function getNbPersonnes(): ?int
    {
        return $this->nbPersonnes;
    }

    public function setNbPersonnes(int $nbPersonnes): self
    {
        $this->nbPersonnes = $nbPersonnes;

        return $this;
    }

    public function getPicture()
    {
        return $this->picture;
    }

    public function setPicture( $picture)
    {
        $this->picture = $picture;

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
     * @return Collection|HotelPackagePeriode[]
     */
    public function getPeriodes(): Collection
    {
        return $this->periodes;
    }

    public function addPeriode(HotelPackagePeriode $periode): self
    {
        if (!$this->periodes->contains($periode)) {
            $this->periodes[] = $periode;
            $periode->setPackage($this);
        }

        return $this;
    }

    public function removePeriode(HotelPackagePeriode $periode): self
    {
        if ($this->periodes->contains($periode)) {
            $this->periodes->removeElement($periode);
            // set the owning side to null (unless already changed)
            if ($periode->getPackage() === $this) {
                $periode->setPackage(null);
            }
        }

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
            $hotelReservationsPackage->setPackage($this);
        }

        return $this;
    }

    public function removeHotelReservationsPackage(HotelReservationPackage $hotelReservationsPackage): self
    {
        if ($this->hotelReservationsPackage->contains($hotelReservationsPackage)) {
            $this->hotelReservationsPackage->removeElement($hotelReservationsPackage);
            // set the owning side to null (unless already changed)
            if ($hotelReservationsPackage->getPackage() === $this) {
                $hotelReservationsPackage->setPackage(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|HotelReservationPackage[]
     */
    public function getReservationsHotels(): Collection
    {
        return $this->reservationsHotels;
    }

    public function addReservationsHotel(HotelReservationPackage $reservationsHotel): self
    {
        if (!$this->reservationsHotels->contains($reservationsHotel)) {
            $this->reservationsHotels[] = $reservationsHotel;
            $reservationsHotel->setPackage($this);
        }

        return $this;
    }

    public function removeReservationsHotel(HotelReservationPackage $reservationsHotel): self
    {
        if ($this->reservationsHotels->contains($reservationsHotel)) {
            $this->reservationsHotels->removeElement($reservationsHotel);
            // set the owning side to null (unless already changed)
            if ($reservationsHotel->getPackage() === $this) {
                $reservationsHotel->setPackage(null);
            }
        }

        return $this;
    }


}
