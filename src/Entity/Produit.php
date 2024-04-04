<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table(name="produit", indexes={@ORM\Index(name="id_c", columns={"id_c"}), @ORM\Index(name="id_client", columns={"id_client"})})
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
     * @var int
     *
     * @ORM\Column(name="id_c", type="integer", nullable=false)
     */
    private $idC;

    /**
     * @var int
     *
     * @ORM\Column(name="id_client", type="integer", nullable=false)
     */
    private $idClient;

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


}
