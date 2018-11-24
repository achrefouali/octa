<?php

namespace App\Traits;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * Description of BaseEntity, Trait, usable with PHP >= 5.6
 *
 * the interface implimentation have to be commented, sothat this fixture will be ignored when loading fixtures
 * to remove from ignore uncomment the implementation
 */
trait BaseEntity {

    use TimestampableEntity;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean", nullable=false)
     */
    protected $enabled = true;

    public function isEnabled() {
        return $this->enabled;
    }

    /**
     * Get enabled
     *
     * @return boolean 
     */
    public function getEnabled() {
        return $this->enabled;
    }
    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return Entity
     */
    public function setEnabled($boolean) {
        $this->enabled = (Boolean) $boolean;

        return $this;
    }

   
    /*
     * Base Upload section
     */
    
    public function getUploadRootDir() {
        // The absolute path of the directory where the uploaded documents are to be saved
        return __DIR__ . '/../../../../public/' . $this->getUploadDir();
    }

    public function getUploadDir() {
        // We get rid of "__DIR" so that we do not have a problem when we display
        // The document / image in the view.
        return 'uploads/' ;
    }
    
    /*
     * End Base upload section
     */
}
