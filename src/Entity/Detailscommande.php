<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DetailscommandeRepository::class)
 */
class Detailscommande
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
     * @var int
     *
     * @ORM\Column(name="num_Detailscommande", type="integer", nullable=false)
     */
    private $numDetailscommande;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_Detailscommande", type="string", length=255, nullable=false)
     */
    private $nomDetailscommande;

    /**
     * @var int
     *
     * @ORM\Column(name="quantite", type="integer", nullable=false)
     */
    private $quantite;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_unitaire", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixUnitaire;

    /**
     * @var float
     *
     * @ORM\Column(name="sous_total", type="float", precision=10, scale=0, nullable=false)
     */
    private $sousTotal;

    /**
     * @var \Commande
     *
     * @ORM\ManyToOne(targetEntity="Commande")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_com", referencedColumnName="id")
     * })
     */
    private $idCom;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumDetailscommande(): ?int
    {
        return $this->numDetailscommande;
    }

    public function setNumDetailscommande(int $numDetailscommande): static
    {
        $this->numDetailscommande = $numDetailscommande;

        return $this;
    }

    public function getNomDetailscommande(): ?string
    {
        return $this->nomDetailscommande;
    }

    public function setNomDetailscommande(string $nomDetailscommande): static
    {
        $this->nomDetailscommande = $nomDetailscommande;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getPrixUnitaire(): ?float
    {
        return $this->prixUnitaire;
    }

    public function setPrixUnitaire(float $prixUnitaire): static
    {
        $this->prixUnitaire = $prixUnitaire;

        return $this;
    }

    public function getSousTotal(): ?float
    {
        return $this->sousTotal;
    }

    public function setSousTotal(float $sousTotal): static
    {
        $this->sousTotal = $sousTotal;

        return $this;
    }

    public function getIdCom(): ?Commande
    {
        return $this->idCom;
    }

    public function setIdCom(?Commande $idCom): static
    {
        $this->idCom = $idCom;

        return $this;
    }


}
