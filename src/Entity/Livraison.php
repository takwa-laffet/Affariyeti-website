<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LivraisonRepository::class)
 */
class Livraison
{
    #[ORM\Id]

    #[ORM\GeneratedValue]
    
    #[ORM\Column]
    
    private ?int $id = null; 

    /**
     * @var string
     *
     * @ORM\Column(name="adresselivraison", type="string", length=255, nullable=false)
     */
    private $adresselivraison;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datecommande", type="datetime", nullable=false)
     */
    private $datecommande;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datelivraison", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $datelivraison = 'CURRENT_TIMESTAMP';

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
     * @var \App\Entity\Depot
     *
     * @ORM\ManyToOne(targetEntity="Depot")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="iddepot", referencedColumnName="iddepot")
     * })
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

    public function setAdresselivraison(string $adresselivraison): static
    {
        $this->adresselivraison = $adresselivraison;

        return $this;
    }

    public function getDatecommande(): ?\DateTimeInterface
    {
        return $this->datecommande;
    }

    public function setDatecommande(\DateTimeInterface $datecommande): static
    {
        $this->datecommande = $datecommande;

        return $this;
    }

    public function getDatelivraison(): ?\DateTimeInterface
    {
        return $this->datelivraison;
    }

    public function setDatelivraison(\DateTimeInterface $datelivraison): static
    {
        $this->datelivraison = $datelivraison;

        return $this;
    }

    public function getStatuslivraison(): ?string
    {
        return $this->statuslivraison;
    }

    public function setStatuslivraison(string $statuslivraison): static
    {
        $this->statuslivraison = $statuslivraison;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): static
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): static
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getIddepot(): ?Depot
    {
        return $this->iddepot;
    }

    public function setIddepot(?Depot $iddepot): static
    {
        $this->iddepot = $iddepot;

        return $this;
    }


}
