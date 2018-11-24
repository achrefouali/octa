<?php

namespace App\Entity;

use App\Traits\BaseEntity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="configuration")
 * @ORM\Entity(repositoryClass="App\Repository\ConfigurationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Configuration
{

    use BaseEntity;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank(message="Télecharger une image.")
     * @Assert\Image()
     */
    private $logo;

    /**
     * @var \App\Entity\Pays
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Pays", inversedBy="events")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pays_id", referencedColumnName="id", nullable=false)
     * })
     *
     */
    private $pays;

    /**
     * @var \App\Entity\Ville
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Ville", inversedBy="events")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ville_id", referencedColumnName="id", nullable=false)
     * })
     *
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomExpediteur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $emailExpediteur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fax;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $emailDirection;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $emailDirection2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $emailAgence;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $banque;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $agence;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numCompteBancaire;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $codeSwift;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $codeIban;

    public function getId(): ?int
    {
        return $this->id;
    }



    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getNomExpediteur(): ?string
    {
        return $this->nomExpediteur;
    }

    public function setNomExpediteur(string $nomExpediteur): self
    {
        $this->nomExpediteur = $nomExpediteur;

        return $this;
    }

    public function getEmailExpediteur(): ?string
    {
        return $this->emailExpediteur;
    }

    public function setEmailExpediteur(string $emailExpediteur): self
    {
        $this->emailExpediteur = $emailExpediteur;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getFax(): ?string
    {
        return $this->fax;
    }

    public function setFax(string $fax): self
    {
        $this->fax = $fax;

        return $this;
    }

    public function getEmailDirection(): ?string
    {
        return $this->emailDirection;
    }

    public function setEmailDirection(?string $emailDirection): self
    {
        $this->emailDirection = $emailDirection;

        return $this;
    }

    public function getEmailDirection2(): ?string
    {
        return $this->emailDirection2;
    }

    public function setEmailDirection2(?string $emailDirection2): self
    {
        $this->emailDirection2 = $emailDirection2;

        return $this;
    }

    public function getEmailAgence(): ?string
    {
        return $this->emailAgence;
    }

    public function setEmailAgence(?string $emailAgence): self
    {
        $this->emailAgence = $emailAgence;

        return $this;
    }

    public function getBanque(): ?string
    {
        return $this->banque;
    }

    public function setBanque(?string $banque): self
    {
        $this->banque = $banque;

        return $this;
    }

    public function getAgence(): ?string
    {
        return $this->agence;
    }

    public function setAgence(?string $agence): self
    {
        $this->agence = $agence;

        return $this;
    }

    public function getNumCompteBancaire(): ?string
    {
        return $this->numCompteBancaire;
    }

    public function setNumCompteBancaire(?string $numCompteBancaire): self
    {
        $this->numCompteBancaire = $numCompteBancaire;

        return $this;
    }

    public function getCodeSwift(): ?string
    {
        return $this->codeSwift;
    }

    public function setCodeSwift(?string $codeSwift): self
    {
        $this->codeSwift = $codeSwift;

        return $this;
    }

    public function getCodeIban(): ?string
    {
        return $this->codeIban;
    }

    public function setCodeIban(?string $codeIban): self
    {
        $this->codeIban = $codeIban;

        return $this;
    }

    public function getPays(): ?Pays
    {
        return $this->pays;
    }

    public function setPays(?Pays $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getVille(): ?Ville
    {
        return $this->ville;
    }

    public function setVille(?Ville $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getLogo()
    {
        return $this->logo;
    }

    public function setLogo( $logo)
    {
        $this->logo = $logo;

        return $this;
    }


}
