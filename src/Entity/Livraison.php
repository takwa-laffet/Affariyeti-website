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
     * @var \Depot
     *
     * @ORM\ManyToOne(targetEntity="Depot")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="iddepot", referencedColumnName="iddepot")
     * })
     */
    private $iddepot;


}
