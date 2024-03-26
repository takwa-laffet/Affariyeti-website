<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TicketEnchereRepository::class)
 */
class TicketEnchere
{
    
    #[ORM\Id]

    #[ORM\GeneratedValue]
    
    #[ORM\Column]
    
    private ?int $ticketId = null;

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

    public function getEnchereId(): ?Enchere
    {
        return $this->enchereId;
    }

    public function setEnchereId(?Enchere $enchereId): static
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
