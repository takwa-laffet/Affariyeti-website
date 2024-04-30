<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TicketEnchere
 *
 * @ORM\Table(name="ticket_enchere")
 * @ORM\Entity
 */
class TicketEnchere
{
    /**
     * @var int
     *
     * @ORM\Column(name="ticket_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $ticketId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="enchere_id", type="integer", nullable=true)
     */
    private $enchereId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="prix", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $prix;


}
