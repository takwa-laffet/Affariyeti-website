<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GrosmotsRepository::class)
 */
class Grosmots
{
    #[ORM\Id]

    #[ORM\GeneratedValue]
    
    #[ORM\Column]
    
    private ?int $idGm = null;
    

    /**
     * @var string
     *
     * @ORM\Column(name="GrosMots", type="string", length=1000, nullable=false)
     */
    private $grosmots;

    public function getIdGm(): ?int
    {
        return $this->idGm;
    }

    public function getGrosmots(): ?string
    {
        return $this->grosmots;
    }

    public function setGrosmots(string $grosmots): static
    {
        $this->grosmots = $grosmots;

        return $this;
    }


}
