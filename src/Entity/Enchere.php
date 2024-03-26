<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Enchere
 *
 * @ORM\Table(name="enchere")
 * @ORM\Entity
 */
class Enchere
{
    /**
     * @var int
     *
     * @ORM\Column(name="enchere_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $enchereId;

    /**
     * @var string
     *
     * @ORM\Column(name="idclcreree", type="string", length=255, nullable=false)
     */
    private $idclcreree;

    /**
     * @var string|null
     *
     * @ORM\Column(name="date_debut", type="string", length=255, nullable=true)
     */
    private $dateDebut;

    /**
     * @var string
     *
     * @ORM\Column(name="heured", type="string", length=5, nullable=false)
     */
    private $heured;

    /**
     * @var string|null
     *
     * @ORM\Column(name="date_fin", type="string", length=255, nullable=true)
     */
    private $dateFin;

    /**
     * @var string
     *
     * @ORM\Column(name="heuref", type="string", length=5, nullable=false)
     */
    private $heuref;

    /**
     * @var string|null
     *
     * @ORM\Column(name="montant_initial", type="string", length=255, nullable=true)
     */
    private $montantInitial;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_enchere", type="string", length=255, nullable=false)
     */
    private $nomEnchere;

    /**
     * @var string|null
     *
     * @ORM\Column(name="montant_final", type="string", length=255, nullable=true)
     */
    private $montantFinal;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=false)
     */
    private $image;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idclenchere", type="integer", nullable=true)
     */
    private $idclenchere;

    public function getEnchereId(): ?int
    {
        return $this->enchereId;
    }

    public function getIdclcreree(): ?string
    {
        return $this->idclcreree;
    }

    public function setIdclcreree(string $idclcreree): static
    {
        $this->idclcreree = $idclcreree;

        return $this;
    }

    public function getDateDebut(): ?string
    {
        return $this->dateDebut;
    }

    public function setDateDebut(?string $dateDebut): static
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getHeured(): ?string
    {
        return $this->heured;
    }

    public function setHeured(string $heured): static
    {
        $this->heured = $heured;

        return $this;
    }

    public function getDateFin(): ?string
    {
        return $this->dateFin;
    }

    public function setDateFin(?string $dateFin): static
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getHeuref(): ?string
    {
        return $this->heuref;
    }

    public function setHeuref(string $heuref): static
    {
        $this->heuref = $heuref;

        return $this;
    }

    public function getMontantInitial(): ?string
    {
        return $this->montantInitial;
    }

    public function setMontantInitial(?string $montantInitial): static
    {
        $this->montantInitial = $montantInitial;

        return $this;
    }

    public function getNomEnchere(): ?string
    {
        return $this->nomEnchere;
    }

    public function setNomEnchere(string $nomEnchere): static
    {
        $this->nomEnchere = $nomEnchere;

        return $this;
    }

    public function getMontantFinal(): ?string
    {
        return $this->montantFinal;
    }

    public function setMontantFinal(?string $montantFinal): static
    {
        $this->montantFinal = $montantFinal;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getIdclenchere(): ?int
    {
        return $this->idclenchere;
    }

    public function setIdclenchere(?int $idclenchere): static
    {
        $this->idclenchere = $idclenchere;

        return $this;
    }


}
