<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use App\Repository\TicketEnchereRepository;
use App\Entity\Enchere; // Import Enchere entity

#[ORM\Entity(repositoryClass: TicketEnchereRepository::class)]
class TicketEnchere
{
    
    #[ORM\Id]

    #[ORM\GeneratedValue]
    
    #[ORM\Column]
    
    private ?int $ticketId = null;
    
    #[ORM\ManyToOne(targetEntity: Enchere::class)] 
    #[ORM\JoinColumn(nullable: false)] private ?Enchere $enchereId = null; 

    #[ORM\Column (length: 255)] private ?string $prix = null;

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
