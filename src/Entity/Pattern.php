<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Traits\BaseEntity;

/**
 * Pattern
 *
 * @ORM\Table(name="motifs")
 * @ORM\Entity(repositoryClass="App\Repository\PatternRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Pattern {

    use BaseEntity;

    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @var string
     *
     * @ORM\Column(name="property_path", type="string", length=45, nullable=false)
     */
    private $propertyPath;

    /**
     * @var string
     *
     * @ORM\Column(name="class_path", type="string", length=255, nullable=false)
     */
    private $classPath;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Notification", mappedBy="pattern")
     */
    private $notification;

  
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->notification = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * @return string
     */
    function __toString() {
        return (string) $this->getPropertyPath();
    }
    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set propertyPath
     *
     * @param string $propertyPath
     *
     * @return Pattern
     */
    public function setPropertyPath($propertyPath)
    {
        $this->propertyPath = $propertyPath;

        return $this;
    }

    /**
     * Get propertyPath
     *
     * @return string
     */
    public function getPropertyPath()
    {
        return $this->propertyPath;
    }

    /**
     * Set classPath
     *
     * @param string $classPath
     *
     * @return Pattern
     */
    public function setClassPath($classPath)
    {
        $this->classPath = $classPath;

        return $this;
    }

    /**
     * Get classPath
     *
     * @return string
     */
    public function getClassPath()
    {
        return $this->classPath;
    }

    /**
     * Add notification
     *
     * @param \App\Entity\Notification $notification
     *
     * @return Pattern
     */
    public function addNotification(\App\Entity\Notification $notification)
    {
        $this->notification[] = $notification;

        return $this;
    }

    /**
     * Remove notification
     *
     * @param \App\Entity\Notification $notification
     */
    public function removeNotification(\App\Entity\Notification $notification)
    {
        $this->notification->removeElement($notification);
    }

    /**
     * Get notification
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNotification()
    {
        return $this->notification;
    }
}
