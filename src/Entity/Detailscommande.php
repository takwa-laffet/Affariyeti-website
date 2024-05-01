<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
<<<<<<< Updated upstream
=======

>>>>>>> Stashed changes
/**
 * Detailscommande
 *
 * @ORM\Table(name="detailscommande", indexes={@ORM\Index(name="id_com", columns={"id_com"})})
 * @ORM\Entity
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
     * @ORM\Column(name="id_com", type="integer", nullable=false)
     */
    private $idCom;

    /**
     * @var int
     *
     * @ORM\Column(name="num_article", type="integer", nullable=false)
     */
    private $numArticle;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_article", type="string", length=255, nullable=false)
     */
    private $nomArticle;

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


}
