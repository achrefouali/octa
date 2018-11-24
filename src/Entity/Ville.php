<?php

namespace App\Entity;

use App\Traits\BaseEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Ville
 *
 * @ORM\Table(name="villes", indexes={@ORM\Index(name="fk_ville_pays1_idx", columns={"pays_id"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Ville
{
    use BaseEntity;
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
     * @ORM\ManyToOne(targetEntity="Pays", inversedBy="villes")
     * @ORM\JoinColumn(name="pays_id", referencedColumnName="id")
     */
    private $pays;

  


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

    public function __toString()
    {
        return (string) $this->getName();
    }


}
