<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Pays
 *
 * @ORM\Table(name="pays")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Pays
{
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
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;


    /**
     * @ORM\OneToMany(targetEntity="Ville", mappedBy="pays", cascade={"remove","persist"})
     */
    private $villes;

    public function __construct()
    {
        $this->villes = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }




    /**
     * Add villes
     *
     * @param \App\Entity\Ville $villes
     * @return Pays
     */
    public function addVille(\App\Entity\Ville $villes)
    {
        $this->villes[] = $villes;
    
        return $this;
    }

    /**
     * Remove villes
     *
     * @param \App\Entity\Ville $villes
     */
    public function removeVille(\App\Entity\Ville $villes)
    {
        $this->villes->removeElement($villes);
    }

    /**
     * Get villes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVilles()
    {
        return $this->villes;
    }

    public function __toString()
    {
        return (string) $this->getName();
    }


}
