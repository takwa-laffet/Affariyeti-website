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


}
