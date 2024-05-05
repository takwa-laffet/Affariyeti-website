<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use App\Entity\Publication;

use Doctrine\ORM\Mapping as ORM;

<<<<<<< HEAD
use App\Repository\CommentaireRepository;
#[ORM\Entity(repositoryClass: CommentaireRepository::class)]
=======
>>>>>>> gestion-user
class Commentaire
{
    
    #[ORM\Id]

    #[ORM\GeneratedValue]
    
    #[ORM\Column]
    
    private ?int $idCom = null;
    
    #[ORM\Column (length: 255)] private ?string $contenu = null;   
    #[ORM\Column(type:"datetime")]
    private ?\DateTimeInterface $dateCom = null;

    #[ORM\ManyToOne(inversedBy: 'Publication')] private ?Publication $idPub = null;
    #[ORM\ManyToOne(inversedBy: 'User')] private ?User $idClient = null;


    public function getIdCom(): ?int
    {
        return $this->idCom;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): static
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getDateCom(): ?\DateTimeInterface
    {
        return $this->dateCom;
    }

    public function setDateCom(\DateTimeInterface $dateCom): static
    {
        $this->dateCom = $dateCom;

        return $this;
    }

    public function getIdPub(): ?Publication
    {
        return $this->idPub;
    }

    public function setIdPub(?Publication $idPub): static
    {
        $this->idPub = $idPub;

        return $this;
    }

    public function getIdClient(): ?User
    {
        return $this->idClient;
    }

    public function setIdClient(?User $idClient): static
    {
        $this->idClient = $idClient;

        return $this;
    }


}
