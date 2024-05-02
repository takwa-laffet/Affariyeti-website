<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Depot
 *
 * @ORM\Table(name="depot")
 * @ORM\Entity
 */
class Depot
{
    /**
     * @var int
     *
     * @ORM\Column(name="iddepot", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iddepot;

    /**
     * @var string
     *
     * @ORM\Column(name="nomdepot", type="string", length=255, nullable=false)
     */
    private $nomdepot;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=false)
     */
    private $adresse;

    public function getIddepot(): ?int
    {
        return $this->iddepot;
    }

    public function getNomdepot(): ?string
    {
        return $this->nomdepot;
    }

    public function setNomdepot(string $nomdepot): self
    {
        $this->nomdepot = $nomdepot;

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

    public function __toString(): string
    {
        return $this->nomdepot;
    }
}