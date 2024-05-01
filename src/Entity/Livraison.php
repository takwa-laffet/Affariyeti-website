<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
<<<<<<< Updated upstream
 * @ORM\Table(name="livraison", indexes={@ORM\Index(name="fk_depot", columns={"iddepott"}), @ORM\Index(name="fk_user", columns={"idclient"})})
=======
 * Livraison
 *
 * @ORM\Table(name="livraison", indexes={@ORM\Index(name="fk_depot", columns={"iddepot"})})
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
     * @ORM\Column(name="datecommande", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
=======
     * @ORM\Column(name="datecommande", type="datetime", nullable=false)
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
     * @ORM\Column(name="latitude", type="float", nullable=false)
=======
     * @ORM\Column(name="latitude", type="float", precision=10, scale=0, nullable=false)
>>>>>>> Stashed changes
     */
    private $latitude;

    /**
     * @var float
     *
<<<<<<< Updated upstream
     * @ORM\Column(name="longitude", type="float", nullable=false)
=======
     * @ORM\Column(name="longitude", type="float", precision=10, scale=0, nullable=false)
>>>>>>> Stashed changes
     */
    private $longitude;

    /**
<<<<<<< Updated upstream
     * @var User|null
     *
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(name="idclient", referencedColumnName="id")
     */
    private $idclient;

    /**
     * @var Depot|null
     *
     * @ORM\ManyToOne(targetEntity=Depot::class)
     * @ORM\JoinColumn(name="iddepott", referencedColumnName="iddepot")
     */
    private $iddepot;

    // Getters and setters...
=======
     * @var Depot
     *
     * @ORM\ManyToOne(targetEntity="Depot")
     * @ORM\JoinColumn(name="iddepot", referencedColumnName="iddepot")
     */
    private $iddepot;
>>>>>>> Stashed changes

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
        return $this->statuslivraison= "en cours";
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

    public function getIdclient(): ?User
    {
        return $this->idclient;
    }

    public function setIdclient(?User $idclient): self
    {
        $this->idclient = $idclient;

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
<<<<<<< Updated upstream
=======
    public function __toString(): string
    {
        return $this->adresselivraison;
    }
   
>>>>>>> Stashed changes
}
