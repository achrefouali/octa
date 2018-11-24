<?php

namespace App\Entity;

use App\Traits\BaseEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * ParticipantType
 *
 * @ORM\Table(name="sponsors_type")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class SponsorType
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
     * @ORM\Column(name="label", type="string", length=50)
     */
    private $label;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Sponsor", mappedBy="type")
     *
     */
    private $sponsors;

    public function __construct()
    {
        $this->sponsors = new ArrayCollection();
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

    public function __toString(): string
    {
        return (string) $this->getLabel();
    }

    /**
     * @return Collection|Sponsor[]
     */
    public function getSponsors(): Collection
    {
        return $this->sponsors;
    }

    public function addSponsor(Sponsor $sponsor): self
    {
        if (!$this->sponsors->contains($sponsor)) {
            $this->sponsors[] = $sponsor;
            $sponsor->setType($this);
        }

        return $this;
    }

    public function removeSponsor(Sponsor $sponsor): self
    {
        if ($this->sponsors->contains($sponsor)) {
            $this->sponsors->removeElement($sponsor);
            // set the owning side to null (unless already changed)
            if ($sponsor->getType() === $this) {
                $sponsor->setType(null);
            }
        }

        return $this;
    }
}
