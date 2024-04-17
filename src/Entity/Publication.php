<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;


class Publication
{

    #[ORM\Id]

    #[ORM\GeneratedValue]
    
    #[ORM\Column]
    
    private ?int $idPub = null;
    #[ORM\Column (length: 255) ] private ?string $contenu = null;   
    #[ORM\Column (length: 255) ] private ?string $photo = null;   

    #[ORM\Column  ] private ?int $nbLikes = null;  
    #[ORM\Column  ] private ?int $nbDislike = null;   
    
    #[ORM\Column(type:"datetime")]
    private ?\DateTimeInterface $datePub = null;

    #[ORM\ManyToOne(inversedBy: 'User')] private ?User $idClient = null;

    public function getIdPub(): ?int
    {
        return $this->idPub;
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

    public function getNbLikes(): ?int
    {
        return $this->nbLikes;
    }

    public function setNbLikes(int $nbLikes): static
    {
        $this->nbLikes = $nbLikes;

        return $this;
    }

    public function getNbDislike(): ?int
    {
        return $this->nbDislike;
    }

    public function setNbDislike(int $nbDislike): static
    {
        $this->nbDislike = $nbDislike;

        return $this;
    }

    public function getDatePub(): ?\DateTimeInterface
    {
        return $this->datePub;
    }

    public function setDatePub(\DateTimeInterface $datePub): static
    {
        $this->datePub = $datePub;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): static
    {
        $this->photo = $photo;

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
