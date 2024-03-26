<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TicketEnchereRepository::class)
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

    public function getTicketId(): ?int
    {
        return $this->ticketId;
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

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(?string $prix): static
    {
        $this->prix = $prix;

        return $this;
    }


}
