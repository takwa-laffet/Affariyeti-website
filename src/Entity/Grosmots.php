<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Grosmots
 *
 * @ORM\Table(name="grosmots")
 * @ORM\Entity
 */
class Grosmots
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_GM", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idGm;

    /**
     * @var string
     *
     * @ORM\Column(name="GrosMots", type="string", length=1000, nullable=false)
     */
    private $grosmots;


}
