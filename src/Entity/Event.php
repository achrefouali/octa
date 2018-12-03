<?php

namespace App\Entity;

use App\Traits\BaseEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="events")
 * @ORM\Entity(repositoryClass="App\Repository\EventRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Event
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $designation2;
	
	
	    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $designation2_en;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Journee", mappedBy="event", cascade={"remove","persist"})
     */
    private $journees;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Supplement", mappedBy="event", cascade={"remove","persist"})
     */
    private $supplements;

    /**
     * @var \App\Entity\Pays
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Pays")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pays_id", referencedColumnName="id", nullable=false)
     * })
     *
     */
    private $pays;

    /**
     * @var \App\Entity\Ville
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Ville")
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
    private $longitude;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $latitude;

    /**
     * @ORM\Column(type="text")
     */
    private $description;
	
	
	 /**
     * @ORM\Column(type="text")
     */
    private $description_en;

    /**
     * @ORM\Column(type="text", length=255, nullable=true)
     */
    private $keywords;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $metadescription;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $facebookLink;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $googleLink;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tweeterLink;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $instagramLink;
	
	/**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    protected $dateDebut;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    protected $dateFin;

  

   

    
   
/*****Excusion */////// 
     /**
     * @ORM\Column(type="string",nullable=true)
     *
     */
    private $excursion;
    private $fileExcusion ;
    private $tempFilenameExcursion;


    public function getExcursion(){
        return $this->excursion ;
    }
    public function setExcursion($excursion){
        $this->excursion = $excursion ;
        return $this ; 
    }

    public function setFileExcursion(UploadedFile $fileExcusion = null)
    {
        $this->fileExcusion = $fileExcusion;
        if (null !== $this->excursion && $fileExcusion !== null ) {
            $this->tempFilenameExcursion = $this->excursion;
            $this->excursion = null;
        }
    }


    /*** @return mixed
     */
    public function getFileExcursion()
    {
        return $this->fileExcusion;
    }
    /**
     * @return mixed
     */
    public function getTempFilenameExcursion()
    {
        return $this->tempFilenameExcursion;
    }

    /**
     * @param mixed $tempFilenameExcursion
     */
    public function setTempFilenameExcursion($tempFilenameExcursion)
    {
        $this->tempFilenameExcursion = $tempFilenameExcursion;
    }

 


/*****Brochure */////// 

 /**
     * @ORM\Column(type="string",nullable=true)
     *
     */
    private $brochureFile;

     private $fileBrochure ;
    private $tempFilenameBrochure;
    public function getBrochureFile(){
        
        return $this->brochureFile;
    }
    
    public function setBrochureFile($brochureFile)
    {
        $this->brochureFile = $brochureFile;

        return $this;
    }




 public function setFileBrochure(UploadedFile $fileBrochure = null)
    {
        $this->fileBrochure = $fileBrochure;
        if (null !== $this->brochureFile && $fileBrochure !== null ) {
            $this->tempFilenameBrochure = $this->brochureFile;
            $this->brochureFile = null;
        }
    }


    /*** @return mixed
     */
    public function getFileBrochure()
    {
        return $this->fileBrochure;
    }
    /**
     * @return mixed
     */
    public function getTempFilenameBrochure()
    {
        return $this->tempFilenameBrochure;
    }

    /**
     * @param mixed $tempFilenameBrochure
     */
    public function setTempFilenameBrochure($tempFilenameBrochure)
    {
        $this->tempFilenameBrochure = $tempFilenameBrochure;
    }





   /**Programe File */ 


/**
     * @ORM\Column(type="string",nullable=true)
     *
     */
    private $programFile;
     private $fileProgram ;
    private $tempFilenameProgram;

    public function getProgramFile()
    {
        return $this->programFile;
    }

    public function setProgramFile($programFile)
    {
        $this->programFile = $programFile;

        return $this;
    }


public function setFileProgram(UploadedFile $fileProgram = null)
    {
        $this->fileProgram = $fileProgram;
        if (null !== $this->programFile && $fileProgram !== null ) {
            $this->tempFilenameProgram = $this->programFile;
            $this->programFile = null;
        }
    }


    /*** @return mixed
     */
    public function getFileProgram()
    {
        return $this->fileProgram;
    }
    /**
     * @return mixed
     */
    public function getTempFilenameProgram()
    {
        return $this->tempFilenameProgram;
    }

    /**
     * @param mixed $tempFilenameProgram
     */
    public function setTempFilenameProgram($tempFilenameProgram)
    {
        $this->tempFilenameProgram = $tempFilenameProgram;
    }



/***Logo Facture*///
 /**
     * @ORM\Column(type="string")
     *
     */
    private $logoFacture;
private $fileLogoFacture ;
    private $tempFilenameLogoFacture;


 public function getLogoFacture()
    {
        return $this->logoFacture;
    }

    public function setLogoFacture($logoFacture)
    {
        $this->logoFacture = $logoFacture;

        return $this;
    }



    public function setFileLogoFacture(UploadedFile $fileLogoFacture = null)
    {
        $this->fileLogoFacture = $fileLogoFacture;
        if (null !== $this->logoFacture && $fileLogoFacture !== null ) {
            $this->tempFilenameLogoFacture = $this->logoFacture;
            $this->logoFacture = null;
        }
    }


    /*** @return mixed
     */
    public function getFileLogoFacture()
    {
        return $this->fileLogoFacture;
    }
    /**
     * @return mixed
     */
    public function getTempFilenameLogoFacture()
    {
        return $this->tempFilenameLogoFacture;
    }

    /**
     * @param mixed $tempFilenameLogoFacture
     */
    public function setTempFilenameLogoFacture($tempFilenameLogoFacture)
    {
        $this->tempFilenameLogoFacture = $tempFilenameLogoFacture;
    }




  /**
     * @ORM\Column(type="string" )
     *
     */
    private $logo;
private $fileLogo;
    private $tempFilenameLogo;

public function getLogo()
    {
        return $this->logo;
    }

    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }



    public function setFileLogo(UploadedFile $fileLogo = null)
    {
        $this->fileLogo = $fileLogo;
        if (null !== $this->logo && $fileLogo !== null ) {
            $this->tempFilenameLogo = $this->logo;
            $this->logo = null;
        }
    }


    /*** @return mixed
     */
    public function getFileLogo()
    {
        return $this->fileLogo;
    }
    /**
     * @return mixed
     */
    public function getTempFilenameLogo()
    {
        return $this->tempFilenameLogo;
    }

    /**
     * @param mixed $tempFilenameLogo
     */
    public function setTempFilenameLogo($tempFilenameLogo)
    {
        $this->tempFilenameLogo = $tempFilenameLogo;
    }




    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tarif", mappedBy="event", cascade={"remove","persist"})
     */
    private $tarifs;

    /**
     * Many Programmes have Many Documents.
     * @ORM\ManyToMany(targetEntity="App\Entity\Document", cascade={"remove","persist"})
     * @ORM\JoinTable(name="events_documents",
     *      joinColumns={@ORM\JoinColumn(name="event_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="document_id", referencedColumnName="id", unique=true)}
     *      )
     */
    private $documents;

    public function __construct()
    {
        $this->documents = new ArrayCollection();
        $this->journees = new ArrayCollection();
        $this->supplements = new ArrayCollection();
        $this->tarifs = new ArrayCollection();
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

    public function getDesignation2(): ?string
    {
        return $this->designation2;
    }

    public function setDesignation2(?string $designation2): self
    {
        $this->designation2 = $designation2;

        return $this;
    }

    public function getDesignation2En(): ?string
    {
        return $this->designation2_en;
    }

    public function setDesignation2En(?string $designation2_en): self
    {
        $this->designation2_en = $designation2_en;

        return $this;
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

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(string $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDescriptionEn(): ?string
    {
        return $this->description_en;
    }

    public function setDescriptionEn(string $description_en): self
    {
        $this->description_en = $description_en;

        return $this;
    }

    public function getKeywords(): ?string
    {
        return $this->keywords;
    }

    public function setKeywords(?string $keywords): self
    {
        $this->keywords = $keywords;

        return $this;
    }

    public function getMetadescription(): ?string
    {
        return $this->metadescription;
    }

    public function setMetadescription(?string $metadescription): self
    {
        $this->metadescription = $metadescription;

        return $this;
    }


    public function getFacebookLink(): ?string
    {
        return $this->facebookLink;
    }

    public function setFacebookLink(?string $facebookLink): self
    {
        $this->facebookLink = $facebookLink;

        return $this;
    }

    public function getGoogleLink(): ?string
    {
        return $this->googleLink;
    }

    public function setGoogleLink(?string $googleLink): self
    {
        $this->googleLink = $googleLink;

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

    public function getInstagramLink(): ?string
    {
        return $this->instagramLink;
    }

    public function setInstagramLink(?string $instagramLink): self
    {
        $this->instagramLink = $instagramLink;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

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

    public function __toString()
    {
        return (string) $this->getDesignation();
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
     * @return Collection|Journee[]
     */
    public function getJournees(): Collection
    {
        return $this->journees;
    }

    public function addJournee(Journee $journee): self
    {
        if (!$this->journees->contains($journee)) {
            $this->journees[] = $journee;
            $journee->setEvent($this);
        }

        return $this;
    }

    public function removeJournee(Journee $journee): self
    {
        if ($this->journees->contains($journee)) {
            $this->journees->removeElement($journee);
            // set the owning side to null (unless already changed)
            if ($journee->getEvent() === $this) {
                $journee->setEvent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Supplement[]
     */
    public function getSupplements(): Collection
    {
        return $this->supplements;
    }

    public function addSupplement(Supplement $supplement): self
    {
        if (!$this->supplements->contains($supplement)) {
            $this->supplements[] = $supplement;
            $supplement->setEvent($this);
        }

        return $this;
    }

    public function removeSupplement(Supplement $supplement): self
    {
        if ($this->supplements->contains($supplement)) {
            $this->supplements->removeElement($supplement);
            // set the owning side to null (unless already changed)
            if ($supplement->getEvent() === $this) {
                $supplement->setEvent(null);
            }
        }

        return $this;
    }

   

    /**
     * @return Collection|Tarif[]
     */
    public function getTarifs(): Collection
    {
        return $this->tarifs;
    }

    public function addTarif(Tarif $tarif): self
    {
        if (!$this->tarifs->contains($tarif)) {
            $this->tarifs[] = $tarif;
            $tarif->setEvent($this);
        }

        return $this;
    }

    public function removeTarif(Tarif $tarif): self
    {
        if ($this->tarifs->contains($tarif)) {
            $this->tarifs->removeElement($tarif);
            // set the owning side to null (unless already changed)
            if ($tarif->getEvent() === $this) {
                $tarif->setEvent(null);
            }
        }

        return $this;
    }



    public function upload($fieldName = '')
    {

        // Si jamais il n'y a pas de fichier (champ facultatif)
        if ($fieldName == '') {

            return;
        }
        if ($fieldName == 'logo'){

            
            // Si on avait un ancien fichier, on le supprime
            if (null !== $this->tempFilenameLogo) {
                $oldFile = $this->getUploadRootDir() . '/' .  $this->tempFilenameLogo;
            
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            }

            // On déplace le fichier envoyé dans le répertoire de notre choix
            $this->fileLogo->move(
                $this->getUploadRootDir(), // Le répertoire de destination
                $this->tempFilenameLogo  // Le nom du fichier à créer, ici « id.extension »
            );
            $this->logo = $this->tempFilenameLogo;
            $this->fileLogo = null;
        }elseif($fieldName == 'logoFacture'){

              if (null !== $this->tempFilenameLogoFacture) {
              $oldFile = $this->getUploadRootDir() . '/' .  $this->tempFilenameLogoFacture;
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            }

                 // On déplace le fichier envoyé dans le répertoire de notre choix
            $this->fileLogoFacture->move(
                $this->getUploadRootDir(), // Le répertoire de destination
                $this->tempFilenameLogoFacture  // Le nom du fichier à créer, ici « id.extension »
            );
            $this->logoFacture = $this->tempFilenameLogoFacture;
            $this->fileLogoFacture = null;
            }elseif($fieldName == 'programFile'){
             if (null !== $this->tempFilenameProgram) {
            $oldFile = $this->getUploadRootDir() . '/' .  $this->tempFilenameProgram;
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            }
                 // On déplace le fichier envoyé dans le répertoire de notre choix
            $this->fileProgram->move(
                $this->getUploadRootDir(), // Le répertoire de destination
                $this->tempFilenameProgram  // Le nom du fichier à créer, ici « id.extension »
            );
            $this->programFile = $this->tempFilenameProgram;
            $this->fileProgram = null;
            }elseif($fieldName == 'brochureFile'){
            if (null !== $this->tempFilenameBrochure) {
            $oldFile = $this->getUploadRootDir() . '/' .  $this->tempFilenameBrochure;
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            }
                // On déplace le fichier envoyé dans le répertoire de notre choix
            $this->fileBrochure->move(
                $this->getUploadRootDir(), // Le répertoire de destination
                $this->tempFilenameBrochure  // Le nom du fichier à créer, ici « id.extension »
            );
            $this->brochureFile = $this->tempFilenameBrochure;
            $this->fileBrochure = null;
            }elseif($fieldName == 'excursion'){
             if (null !== $this->tempFilenameExcursion) {
            $oldFile = $this->getUploadRootDir() . '/' .  $this->tempFilenameExcursion;
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            }
                 // On déplace le fichier envoyé dans le répertoire de notre choix
            $this->fileExcusion->move(
                $this->getUploadRootDir(), // Le répertoire de destination
                $this->tempFilenameExcursion  // Le nom du fichier à créer, ici « id.extension »
            );
            $this->excursion = $this->tempFilenameExcursion;
            $this->fileExcusion = null;
            }
    }



     public function getUploadRootDir()
    {
        return __DIR__ . '/../public/uploads/events';
    }






}
