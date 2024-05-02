<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Livraison
 *
 * @ORM\Table(name="livraison", indexes={@ORM\Index(name="fk_depot", columns={"iddepot"})})
 * @ORM\Entity
 */
class Livraison
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="adresselivraison", type="string", length=255, nullable=false)
     */
    private $adresselivraison;

    /**
     * @var \DateTimeInterface
     *
     * @ORM\Column(name="datecommande", type="datetime", nullable=false)
     */
    private $datecommande;

    /**
     * @var \DateTimeInterface
     *
     * @ORM\Column(name="datelivraison", type="datetime", nullable=false)
     */
    private $datelivraison;

    /**
     * @var string
     *
     * @ORM\Column(name="statuslivraison", type="string", length=255, nullable=false)
     */
    private $statuslivraison;

    /**
     * @var float
     *
     * @ORM\Column(name="latitude", type="float", precision=10, scale=0, nullable=false)
     */
    private $latitude;

    /**
     * @var float
     *
     * @ORM\Column(name="longitude", type="float", precision=10, scale=0, nullable=false)
     */
    private $longitude;

    /**
     * @var Depot
     *
     * @ORM\ManyToOne(targetEntity="Depot")
     * @ORM\JoinColumn(name="iddepot", referencedColumnName="iddepot")
     */
    private $iddepot;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdresselivraison(): ?string
    {
        return $this->adresselivraison;
    }

    public function setAdresselivraison(string $adresselivraison): self
    {
        $this->adresselivraison = $adresselivraison;

        return $this;
    }

    public function getDatecommande(): ?\DateTimeInterface
    {
        return $this->datecommande;
    }

    public function setDatecommande(\DateTimeInterface $datecommande): self
    {
        $this->datecommande = $datecommande;

        return $this;
    }

    public function getDatelivraison(): ?\DateTimeInterface
    {
        return $this->datelivraison;
    }

    public function setDatelivraison(\DateTimeInterface $datelivraison): self
    {
        $this->datelivraison = $datelivraison;

        return $this;
    }

    public function getStatuslivraison(): ?string
    {
        return $this->statuslivraison;
    }

    public function setStatuslivraison(string $statuslivraison): self
    {
        $this->statuslivraison = $statuslivraison;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getIddepot(): ?Depot
    {
        return $this->iddepot;
    }

    public function setIddepot(?Depot $iddepot): self
    {
        $this->iddepot = $iddepot;

        return $this;
    }
}
