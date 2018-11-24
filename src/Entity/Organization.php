<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrganizationRepository")
 */
class Organization
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
    private $society;


    /**
     * @ORM\ManyToOne(targetEntity="Pays")
     * @ORM\JoinColumn(name="pays_id", referencedColumnName="id")
     */
    private $pays;
    /**
     * @return \App\Entity\Pays
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * @param \App\Entity\Pays $pays
     */
    public function setPays(\App\Entity\Pays $pays)
    {
        $this->pays = $pays;
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastnameResponsable(): ?string
    {
        return $this->lastnameResponsable;
    }

    public function setLastnameResponsable(string $lastnameResponsable): self
    {
        $this->lastnameResponsable = $lastnameResponsable;

        return $this;
    }

    public function getSociety(): ?string
    {
        return $this->society;
    }

    public function setSociety(string $society): self
    {
        $this->society = $society;

        return $this;
    }

}
