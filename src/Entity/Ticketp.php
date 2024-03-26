<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ticketp
 *
 * @ORM\Table(name="ticketp")
 * @ORM\Entity
 */
class Ticketp
{
    /**
     * @var int
     *
     * @ORM\Column(name="ticketp_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $ticketpId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ticket_id", type="integer", nullable=true)
     */
    private $ticketId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="client_id", type="integer", nullable=true)
     */
    private $clientId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="enchere_id", type="integer", nullable=true)
     */
    private $enchereId;

    public function getTicketpId(): ?int
    {
        return $this->ticketpId;
    }

    public function getTicketId(): ?int
    {
        return $this->ticketId;
    }

    public function setTicketId(?int $ticketId): static
    {
        $this->ticketId = $ticketId;

        return $this;
    }

    public function getClientId(): ?int
    {
        return $this->clientId;
    }

    public function setClientId(?int $clientId): static
    {
        $this->clientId = $clientId;

        return $this;
    }

    public function getEnchereId(): ?int
    {
        return $this->enchereId;
    }

    public function setEnchereId(?int $enchereId): static
    {
        $this->enchereId = $enchereId;

        return $this;
    }


}
