<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commande
 *
 * @ORM\Table(name="commande")
 * @ORM\Entity
 */
class Commande
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
     * @ORM\Column(name="etat", type="string", length=255, nullable=false)
     */
    private $etat;

    /**
     * @var int
     *
     * @ORM\Column(name="cmd_client", type="integer", nullable=false)
     */
    private $cmdClient;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="cmd_date", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $cmdDate = 'CURRENT_TIMESTAMP';


}
