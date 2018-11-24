<?php

namespace App\Entity;

use App\Traits\BaseEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="devises")
 * @ORM\Entity(repositoryClass="App\Repository\DeviseRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Devise
{

    use BaseEntity;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $symbol;

    /**
     * @ORM\Column(type="float")
     */
    private $coeff;

    /**
     * @ORM\Column(type="boolean")
     */
    private $main;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getSymbol(): ?string
    {
        return $this->symbol;
    }

    public function setSymbol(?string $symbol): self
    {
        $this->symbol = $symbol;

        return $this;
    }

    public function getCoeff(): ?float
    {
        return $this->coeff;
    }

    public function setCoeff(float $coeff): self
    {
        $this->coeff = $coeff;

        return $this;
    }

    public function getMain(): ?bool
    {
        return $this->main;
    }

    public function setMain(bool $main): self
    {
        $this->main = $main;

        return $this;
    }
}
