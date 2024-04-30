<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categoriecodepromo
 *
 * @ORM\Table(name="categoriecodepromo")
 * @ORM\Entity
 */
class Categoriecodepromo
{
    /**
     * @var int
     *
     * @ORM\Column(name="idCcp", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idccp;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255, nullable=false)
     */
    private $code;

    /**
     * @var int
     *
     * @ORM\Column(name="valeur", type="integer", nullable=false)
     */
    private $valeur;

    /**
     * @var int
     *
     * @ORM\Column(name="limite", type="integer", nullable=false)
     */
    private $limite;


}
