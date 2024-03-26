<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandeRepository::class)
 */
class Commande
{
    #[ORM\Id]

    #[ORM\GeneratedValue]
    
    #[ORM\Column]
    
    private ?int $id = null;

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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): static
    {
        $this->etat = $etat;

        return $this;
    }

    public function getCmdClient(): ?int
    {
        return $this->cmdClient;
    }

    public function setCmdClient(int $cmdClient): static
    {
        $this->cmdClient = $cmdClient;

        return $this;
    }

    public function getCmdDate(): ?\DateTimeInterface
    {
        return $this->cmdDate;
    }

    public function setCmdDate(\DateTimeInterface $cmdDate): static
    {
        $this->cmdDate = $cmdDate;

        return $this;
    }


}
