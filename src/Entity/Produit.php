<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table(name="produit", indexes={@ORM\Index(name="id_client", columns={"id_client"}), @ORM\Index(name="id_c", columns={"id_c"})})
 * @ORM\Entity
 */
class Produit
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_p", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idP;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_p", type="string", length=300, nullable=false)
     */
    private $nomP;

    /**
     * @var string
     *
     * @ORM\Column(name="description_p", type="string", length=300, nullable=false)
     */
    private $descriptionP;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_p", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixP;

    /**
     * @var string
     *
     * @ORM\Column(name="image_p", type="string", length=255, nullable=false)
     */
    private $imageP;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_client", referencedColumnName="id")
     * })
     */
    private $idClient;

    /**
     * @var \Categorie
     *
     * @ORM\ManyToOne(targetEntity="Categorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_c", referencedColumnName="id_c")
     * })
     */
    private $idC;

    public function getIdP(): ?int
    {
        return $this->idP;
    }

    public function getNomP(): ?string
    {
        return $this->nomP;
    }

    public function setNomP(string $nomP): static
    {
        $this->nomP = $nomP;

        return $this;
    }

    public function getDescriptionP(): ?string
    {
        return $this->descriptionP;
    }

    public function setDescriptionP(string $descriptionP): static
    {
        $this->descriptionP = $descriptionP;

        return $this;
    }

    public function getPrixP(): ?float
    {
        return $this->prixP;
    }

    public function setPrixP(float $prixP): static
    {
        $this->prixP = $prixP;

        return $this;
    }

    public function getImageP(): ?string
    {
        return $this->imageP;
    }

    public function setImageP(string $imageP): static
    {
        $this->imageP = $imageP;

        return $this;
    }

    public function getIdClient(): ?User
    {
        return $this->idClient;
    }

    public function setIdClient(?User $idClient): static
    {
        $this->idClient = $idClient;

        return $this;
    }

    public function getIdC(): ?Categorie
    {
        return $this->idC;
    }

    public function setIdC(?Categorie $idC): static
    {
        $this->idC = $idC;

        return $this;
    }


}
