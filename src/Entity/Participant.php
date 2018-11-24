<?php

namespace App\Entity;

use App\Traits\BaseEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table(name="participants")
 * @ORM\Entity(repositoryClass="App\Repository\ParticipantRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Participant extends User implements UserInterface
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
     * @ORM\Column(name="gender", type="string", length=20, nullable=true)
     */
    private $gender;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;

    /**
     * @Gedmo\Slug(fields={"firstname", "lastname"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=60, unique=true)
     */
    private $email;
    

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $societe;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $poste;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telephone;


    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $biographie;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tweeterLink;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $linkedinLink;



    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telephone2;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $salt;


    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Programme", mappedBy="intervenants")
     */
    private $programmes;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reservation", mappedBy="participant")
     */
    private $reservations;


    /**
     * @var \App\Entity\ParticipantType
     *
     * @ORM\ManyToOne(targetEntity="\App\Entity\ParticipantType", inversedBy="participants")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="participant_type_id", referencedColumnName="id")
     * })
     */
    private $type;


    /**
     * @ORM\Column(type="string", nullable=true)
     *
     * @Assert\NotBlank(message="Please, upload the hotel picture as an Image file.")
     * @Assert\Image()
     */
    private $picture;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Role", inversedBy="users", fetch="EAGER", cascade={"persist"})
     * @ORM\JoinTable(name="user_has_role",
     *   joinColumns={
     *     @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     *   }
     * )
     */
    protected $role;


    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateArrive;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime" , nullable=true)
     */
    private $dateDepart;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $numVolArrive;


    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $numVolDepart;


    /**
     * @var string
     *
     * @ORM\Column(name="nationalite", type="string", length=255, nullable=true)
     */
    private $nationalite;


    /**
     * @ORM\Column(type="string", length=255,nullable=true )
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255,nullable=true )
     */
    private $codePostal;

    /**
     * @ORM\Column(type="string", length=255,nullable=true )
     */
    private $country;


    /**
     * @ORM\Column(type="time",nullable=true )
     */
    private $heureArrival;
    /**
     * @ORM\Column(type="time",nullable=true )
     */
    private $heureDeparture;

    /**
     * @ORM\Column(type="integer",nullable=true )
     */
    private $nbAccompanying;

    public function getNbAccompanying(){
        return $this->nbAccompanying;
    }

    public function setNbAccompanying($nbAccompanying){
        $this->nbAccompanying = $nbAccompanying;

        return $this;
    }



    /**
     * @ORM\ManyToOne(targetEntity="Pays",cascade={"persist"})
     * @ORM\JoinColumn(name="pays_id", referencedColumnName="id")
     */
    private $pays;

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress( $address)
    {
        $this->address = $address;

        return $this;
    }
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    public function setCodePostal ($codePostal)
    {
        $this->codePostal = $codePostal;

        return $this;
    }
    public function getCountry()
    {
        return $this->country;
    }

    public function setCountry( $country)
    {
        $this->country = $country;

        return $this;
    }
    public function getHeureArrival()
    {
        return $this->heureArrival;
    }

    public function setHeureArrival($heureArrival)
    {
        $this->heureArrival = $heureArrival;

        return $this;
    }
    public function getHeureDeparture()
    {
        return $this->heureDeparture;
    }

    public function setHeureDeparture($heureDeparture)
    {
        $this->heureDeparture = $heureDeparture;

        return $this;
    }


    public function getPays()
    {
        return $this->pays;
    }

    public function setPays( $pays)
    {
        $this->pays = $pays;

        return $this;
    }

    public function __construct()
    {
        $this->programmes = new ArrayCollection();
        $this->reservations = new ArrayCollection();
        $this->role = new ArrayCollection();
    }



    public function getUsername()
    {
        return $this->username;
    }

    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return $this->password.'{'.$this->salt.'}';
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRoles()
    {
        return $this->role->toArray();
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->getFirstname(). ' '. $this->getLastname();
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getSociete(): ?string
    {
        return $this->societe;
    }

    public function setSociete(string $societe): self
    {
        $this->societe = $societe;

        return $this;
    }

    public function getPoste(): ?string
    {
        return $this->poste;
    }

    public function setPoste(string $poste): self
    {
        $this->poste = $poste;

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

    public function getBiographie(): ?string
    {
        return $this->biographie;
    }

    public function setBiographie(?string $biographie): self
    {
        $this->biographie = $biographie;

        return $this;
    }

    public function getTweeterLink(): ?string
    {
        return $this->tweeterLink;
    }

    public function setTweeterLink(?string $tweeterLink): self
    {
        $this->tweeterLink = $tweeterLink;

        return $this;
    }

    public function getLinkedinLink(): ?string
    {
        return $this->linkedinLink;
    }

    public function setLinkedinLink(?string $linkedinLink): self
    {
        $this->linkedinLink = $linkedinLink;

        return $this;
    }

    public function getTelephone2(): ?string
    {
        return $this->telephone2;
    }

    public function setTelephone2(?string $telephone2): self
    {
        $this->telephone2 = $telephone2;

        return $this;
    }

    public function setSalt(string $salt): self
    {
        $this->salt = $salt;

        return $this;
    }

    public function getPicture()
    {
        return $this->picture;
    }

    public function setPicture($picture)
    {
        $this->picture = $picture;

        if ($picture) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }

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
            $programme->addIntervenant($this);
        }

        return $this;
    }

    public function removeProgramme(Programme $programme): self
    {
        if ($this->programmes->contains($programme)) {
            $this->programmes->removeElement($programme);
            $programme->removeIntervenant($this);
        }

        return $this;
    }

    /**
     * @return Collection|Reservation[]
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->setParticipant($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->contains($reservation)) {
            $this->reservations->removeElement($reservation);
            // set the owning side to null (unless already changed)
            if ($reservation->getParticipant() === $this) {
                $reservation->setParticipant(null);
            }
        }

        return $this;
    }

    public function getType(): ?ParticipantType
    {
        return $this->type;
    }

    public function setType(?ParticipantType $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Pass an ARRAY of Roles objects and will clear the collection and re-set it with new Roles.
     * Type hinted array due to interface.
     * @param array $roles Of Roles objects.
     */
    public function setRoles(array $roles) {
        $this->role->clear();
        foreach ($roles as $role) {
            $this->addRole($role);
        }
    }

    /**
     * @return Collection|Role[]
     */
    public function getRole(): Collection
    {
        return $this->role;
    }

    public function addRole(Role $role): self
    {
        if (!$this->role->contains($role)) {
            $this->role[] = $role;
        }

        return $this;
    }

    public function removeRole(Role $role): self
    {
        if ($this->role->contains($role)) {
            $this->role->removeElement($role);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getFirstname().' '.$this->getLastname();
    }

    public function getDateArrive(): ?\DateTimeInterface
    {
        return $this->dateArrive;
    }

    public function setDateArrive(?\DateTimeInterface $dateArrive): self
    {
        $this->dateArrive = $dateArrive;

        return $this;
    }

    public function getDateDepart(): ?\DateTimeInterface
    {
        return $this->dateDepart;
    }

    public function setDateDepart(?\DateTimeInterface $dateDepart): self
    {
        $this->dateDepart = $dateDepart;

        return $this;
    }

    public function getNumVolArrive(): ?string
    {
        return $this->numVolArrive;
    }

    public function setNumVolArrive(string $numVolArrive): self
    {
        $this->numVolArrive = $numVolArrive;

        return $this;
    }

    public function getNumVolDepart(): ?string
    {
        return $this->numVolDepart;
    }

    public function setNumVolDepart(string $numVolDepart): self
    {
        $this->numVolDepart = $numVolDepart;

        return $this;
    }

    public function getNationalite(): ?string
    {
        return $this->nationalite;
    }

    public function setNationalite(string $nationalite): self
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(?string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }


}
