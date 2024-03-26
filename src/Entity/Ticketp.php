<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TicketpRepository::class)
 */
class Ticketp
{
 
    #[ORM\Id]

    #[ORM\GeneratedValue]
    
    #[ORM\Column]
    
    private ?int $ticketpId = null;

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

    public function getTicketId(): ?TicketEnchere
    {
        return $this->ticketId;
    }

    public function setTicketId(?int $ticketId): static
    {
        $this->ticketId = $ticketId;

        return $this;
    }

    public function getClientId(): ?User
    {
        return $this->clientId;
    }

    public function setClientId(?int $clientId): static
    {
        $this->clientId = $clientId;

        return $this;
    }

    public function getEnchereId(): ?Enchere
    {
        return $this->enchereId;
    }

    public function setEnchereId(?int $enchereId): static
    {
        $this->enchereId = $enchereId;

        return $this;
    }


}
