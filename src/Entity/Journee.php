<?php

namespace App\Entity;

use App\Traits\BaseEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="journees")
 * @ORM\Entity(repositoryClass="App\Repository\JourneeRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Journee
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
     * @ORM\Column(type="string", length=255)
     */
    private $designation_en;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Event", inversedBy="journees")
     * @ORM\JoinColumn(name="event_id", referencedColumnName="id")
     */
    private $event;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Programme", mappedBy="journee")
     */
    private $programmes;
		
	/**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    protected $date;


    /**
     * Many Journees have Many Images.
     * @ORM\ManyToMany(targetEntity="App\Entity\Image")
     * @ORM\JoinTable(name="journees_images",
     *      joinColumns={@ORM\JoinColumn(name="journee_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="document_id", referencedColumnName="id", unique=true)}
     *      )
     */
    private $images;

    public function __construct()
    {
        $this->programmes = new ArrayCollection();
        $this->images = new ArrayCollection();
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

    public function getDesignationEn(): ?string
    {
        return $this->designation_en;
    }

    public function setDesignationEn(string $designation_en): self
    {
        $this->designation_en = $designation_en;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

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

    /**
     * @return Collection|Programme[]
     */
    public function getProgrammes(): Collection
    {
        return $this->programmes;
    }

    public function addProgramme(Programme $programme): self
    {
        if (!$this->programmes->contains($programme)) {
            $this->programmes[] = $programme;
            $programme->setJournee($this);
        }

        return $this;
    }

    public function removeProgramme(Programme $programme): self
    {
        if ($this->programmes->contains($programme)) {
            $this->programmes->removeElement($programme);
            // set the owning side to null (unless already changed)
            if ($programme->getJournee() === $this) {
                $programme->setJournee(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
        }

        return $this;
    }


}
