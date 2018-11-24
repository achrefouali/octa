<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Traits\BaseEntity;
use \Doctrine\Common\Collections\ArrayCollection;

/**
 * Notification
 *
 * @ORM\Table(name="notifications")
 * @ORM\Entity(repositoryClass="App\Repository\NotificationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Notification {

    use BaseEntity;

    /**
     * @var integer
     *
     * @ORM\Column(name="notification_type", type="integer", nullable=true)
     */
    private $notificationType;

    /**
     * @var string
     *
     * @ORM\Column(name="subject", type="string", length=250, nullable=false)
     */
    private $subject;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Pattern", inversedBy="notification")
     * @ORM\JoinTable(name="notification_has_pattern",
     *   joinColumns={
     *     @ORM\JoinColumn(name="notification_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="pattern_id", referencedColumnName="id")
     *   }
     * )
     */
    private $pattern;

    /**
     * Constructor
     */
    public function __construct() {
        $this->pattern = new ArrayCollection();
        $this->notification = new ArrayCollection();
    }

    /**
     * Set notificationType
     *
     * @param integer $notificationType
     * @return Notification
     */
    public function setNotificationType($notificationType) {
        $this->notificationType = $notificationType;

        return $this;
    }

    /**
     * Get notificationType
     *
     * @return integer 
     */
    public function getNotificationType() {
        return $this->notificationType;
    }

    /**
     * Set subject
     *
     * @param string $subject
     * @return Notification
     */
    public function setSubject($subject) {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string 
     */
    public function getSubject() {
        return $this->subject;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Notification
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Add pattern
     *
     * @param \App\Entity\Pattern $pattern
     * @return Notification
     */
    public function addPattern(\App\Entity\Pattern $pattern) {
        $this->pattern[] = $pattern;

        return $this;
    }

    /**
     * Remove pattern
     *
     * @param \App\Entity\Pattern $pattern
     */
    public function removePattern(\App\Entity\Pattern $pattern) {
        $this->pattern->removeElement($pattern);
    }

    /**
     * Get pattern
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPattern() {
        return $this->pattern;
    }

    public function __toString() {
        return (string) $this->getSubject();
    }

}
