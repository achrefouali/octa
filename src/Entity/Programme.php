<?php

namespace App\Entity;

use App\Traits\BaseEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="programmes")
 * @ORM\Entity(repositoryClass="App\Repository\ProgrammeRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Programme
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
    private $designationEn;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptionEn;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbPlacesDisponibles;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $emplacement;

    /**
     * @ORM\Column(type="boolean")
     */
    private $inscriptionActive;




    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Participant", inversedBy="programmes")
     * @ORM\JoinTable(name="programmes_intervenants",
     *   joinColumns={
     *     @ORM\JoinColumn(name="programme_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="intervenant_id", referencedColumnName="id")
     *   }
     * )
     */
    private $intervenants;



    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Journee", inversedBy="programmes")
     * @ORM\JoinColumn(name="journee_id", referencedColumnName="id")
     */
    private $journee;

	
	/**
     * @var \DateTime
     * @ORM\Column(type="time")
     */
    protected $heureDebut;

    /**
     * @var \DateTime
     * @ORM\Column(type="time")
     */
    protected $heureFin;

    /**
     * Many Programmes have Many Documents.
     * @ORM\ManyToMany(targetEntity="App\Entity\Document")
     * @ORM\JoinTable(name="programmes_documents",
     *      joinColumns={@ORM\JoinColumn(name="programme_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="document_id", referencedColumnName="id", unique=true)}
     *      )
     */
    private $documents;


    /**
     * Many Programmes have Many Images.
     * @ORM\ManyToMany(targetEntity="App\Entity\Image")
     * @ORM\JoinTable(name="programmes_images",
     *      joinColumns={@ORM\JoinColumn(name="programme_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="image_id", referencedColumnName="id", unique=true)}
     *      )
     */
    private $images;


    /**
     * Many Programmes have Many Videos.
     * @ORM\ManyToMany(targetEntity="App\Entity\Video")
     * @ORM\JoinTable(name="programmes_videos",
     *      joinColumns={@ORM\JoinColumn(name="programme_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="video_id", referencedColumnName="id", unique=true)}
     *      )
     */
    private $videos;

    public function __construct()
    {
        $this->intervenants = new ArrayCollection();
        $this->documents = new ArrayCollection();
        $this->images = new ArrayCollection();
        $this->videos = new ArrayCollection();
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

    public function getNbPlacesDisponibles(): ?int
    {
        return $this->nbPlacesDisponibles;
    }

    public function setNbPlacesDisponibles(int $nbPlacesDisponibles): self
    {
        $this->nbPlacesDisponibles = $nbPlacesDisponibles;

        return $this;
    }

    public function getEmplacement(): ?string
    {
        return $this->emplacement;
    }

    public function setEmplacement(string $emplacement): self
    {
        $this->emplacement = $emplacement;

        return $this;
    }

    public function getInscriptionActive(): ?bool
    {
        return $this->inscriptionActive;
    }

    public function setInscriptionActive(bool $inscriptionActive): self
    {
        $this->inscriptionActive = $inscriptionActive;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }



    /**
     * @return Collection|Participant[]
     */
    public function getIntervenants(): Collection
    {
        return $this->intervenants;
    }

    public function addIntervenant(Participant $intervenant): self
    {
        if (!$this->intervenants->contains($intervenant)) {
            $this->intervenants[] = $intervenant;
        }

        return $this;
    }

    public function removeIntervenant(Participant $intervenant): self
    {
        if ($this->intervenants->contains($intervenant)) {
            $this->intervenants->removeElement($intervenant);
        }

        return $this;
    }

    public function getJournee(): ?Journee
    {
        return $this->journee;
    }

    public function setJournee(?Journee $journee): self
    {
        $this->journee = $journee;

        return $this;
    }

    /**
     * @return Collection|Document[]
     */
    public function getDocuments(): Collection
    {
        return $this->documents;
    }

    public function addDocument(Document $document): self
    {
        if (!$this->documents->contains($document)) {
            $this->documents[] = $document;
        }

        return $this;
    }

    public function removeDocument(Document $document): self
    {
        if ($this->documents->contains($document)) {
            $this->documents->removeElement($document);
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

    /**
     * @return Collection|Video[]
     */
    public function getVideos(): Collection
    {
        return $this->videos;
    }

    public function addVideo(Video $video): self
    {
        if (!$this->videos->contains($video)) {
            $this->videos[] = $video;
        }

        return $this;
    }

    public function removeVideo(Video $video): self
    {
        if ($this->videos->contains($video)) {
            $this->videos->removeElement($video);
        }

        return $this;
    }

    public function getHeureDebut(): ?\DateTimeInterface
    {
        return $this->heureDebut;
    }

    public function setHeureDebut(\DateTimeInterface $heureDebut): self
    {
        $this->heureDebut = $heureDebut;

        return $this;
    }

    public function getHeureFin(): ?\DateTimeInterface
    {
        return $this->heureFin;
    }

    public function setHeureFin(\DateTimeInterface $heureFin): self
    {
        $this->heureFin = $heureFin;

        return $this;
    }

    public function getDesignationEn(): ?string
    {
        return $this->designationEn;
    }

    public function setDesignationEn(string $designationEn): self
    {
        $this->designationEn = $designationEn;

        return $this;
    }

    public function getDescriptionEn(): ?string
    {
        return $this->descriptionEn;
    }

    public function setDescriptionEn(?string $descriptionEn): self
    {
        $this->descriptionEn = $descriptionEn;

        return $this;
    }


}
