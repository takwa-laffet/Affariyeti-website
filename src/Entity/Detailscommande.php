<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use App\Repository\DetailscommandeRepository;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: DetailscommandeRepository::class)]
class Detailscommande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'integer')]
    private ?int $idCom = null;

    #[ORM\Column(type: 'integer')]
    #[Assert\NotBlank]
    #[Assert\Positive]
    private ?int $numArticle = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    private ?string $nomArticle = null;

    #[ORM\Column(type: 'integer')]
    #[Assert\NotBlank]
    #[Assert\Positive]
    private ?int $quantite = null;

    #[ORM\Column(type: 'float')]
    #[Assert\NotBlank]
    #[Assert\Positive]
    private ?float $prixUnitaire = null;

    #[ORM\Column(type: 'float')]
    #[Assert\NotBlank]
    #[Assert\Positive]
    private ?float $sousTotal = null;

    #[ORM\ManyToOne(targetEntity: Commande::class, inversedBy: "detailsCommande")]
    #[ORM\JoinColumn(name: "id_com", referencedColumnName: "id", onDelete: "CASCADE")]
    #[Assert\NotBlank]
  
    private ?Commande $commande;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdCom(): ?int
    {
        return $this->idCom;
    }

    public function setIdCom(?int $idCom): self
    {
        $this->idCom = $idCom;

        return $this;
    }

    public function getNumArticle(): ?int
    {
        return $this->numArticle;
    }

    public function setNumArticle(int $numArticle): self
    {
        $this->numArticle = $numArticle;

        return $this;
    }

    public function getNomArticle(): ?string
    {
        return $this->nomArticle;
    }

    public function setNomArticle(string $nom_article): self
    {
        $this->nomArticle = $nom_article;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getPrixUnitaire(): ?float
    {
        return $this->prixUnitaire;
    }

    public function setPrixUnitaire(float $prixUnitaire): self
    {
        $this->prixUnitaire = $prixUnitaire;

        return $this;
    }

    public function getSousTotal(): ?float
    {
        return $this->sousTotal;
    }

    public function setSousTotal(float $sous_Total): self
    {
        $this->sousTotal = $sous_Total;

        return $this;
    }

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(?Commande $commande): self
    {
        $this->commande = $commande;

        return $this;
    }

    public function __toString(): string
    {
        return $this->numArticle . ' - ' . $this->nomArticle;
    }
}
