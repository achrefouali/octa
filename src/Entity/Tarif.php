<?php

namespace App\Entity;

use App\Traits\BaseEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="tarifs")
 * @ORM\Entity(repositoryClass="App\Repository\TarifRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Tarif
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
    private $label;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\Column(type="float",nullable=true)
     */
    private $prixAccompagnant;

    /**
     * @ORM\ManyToOne(targetEntity="Event", inversedBy="tarifs")
     * @ORM\JoinColumn(name="event_id", referencedColumnName="id", nullable=false)
     */
    private $event;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ParticipantType", mappedBy="tarif")
     *
     */
    private $participantTypes;

    public function __construct()
    {
        $this->participantTypes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

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

   public function getPrixAccompagnant(): ?float
    {
        return $this->prixAccompagnant;
    }

    public function setPrixAccompagnant(float $prixAccompagnant): self
{
    $this->prixAccompagnant = $prixAccompagnant;

    return $this;
}

    /**
     * @return Collection|ParticipantType[]
     */
    public function getParticipantTypes(): Collection
    {
        return $this->participantTypes;
    }

    public function addParticipantType(ParticipantType $participantType): self
    {
        if (!$this->participantTypes->contains($participantType)) {
            $this->participantTypes[] = $participantType;
            $participantType->setTarif($this);
        }

        return $this;
    }

    public function removeParticipantType(ParticipantType $participantType): self
    {
        if ($this->participantTypes->contains($participantType)) {
            $this->participantTypes->removeElement($participantType);
            // set the owning side to null (unless already changed)
            if ($participantType->getTarif() === $this) {
                $participantType->setTarif(null);
            }
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
}
