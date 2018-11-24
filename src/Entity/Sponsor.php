<?php

namespace App\Entity;

use App\Traits\BaseEntity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="sponsors")
 * @ORM\Entity(repositoryClass="App\Repository\SponsorRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Sponsor
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
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank(message="Please, upload the Sponsor picture as an Image file.")
     * @Assert\Image(
     *     maxSize = "1024k",
     *     mimeTypesMessage = "Please upload a valid Picture"
     * )
     */
    private $logo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $siteWeb;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SponsorType")
     * @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     *     })
     */
    private $type;


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

    public function getLogo()
    {
        return $this->logo;
    }

    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    public function getSiteWeb(): ?string
    {
        return $this->siteWeb;
    }

    public function setSiteWeb(?string $siteWeb): self
    {
        $this->siteWeb = $siteWeb;

        return $this;
    }

    public function getType(): ?SponsorType
    {
        return $this->type;
    }

    public function setType(?SponsorType $type): self
    {
        $this->type = $type;

        return $this;
    }
}
