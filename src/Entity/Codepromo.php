<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CodepromoRepository::class)
 */
class Codepromo
{
    /**
     * @var int
     *
     * @ORM\Column(name="idCode", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcode;

    /**
     * @var int
     *
     * @ORM\Column(name="userId", type="integer", nullable=false)
     */
    private $userid;

    /**
     * @var int
     *
     * @ORM\Column(name="idCategorieCode", type="integer", nullable=false)
     */
    private $idcategoriecode;

    public function getIdcode(): ?int
    {
        return $this->idcode;
    }

    public function getUserid(): ?int
    {
        return $this->userid;
    }

    public function setUserid(int $userid): static
    {
        $this->userid = $userid;

        return $this;
    }

    public function getIdcategoriecode(): ?int
    {
        return $this->idcategoriecode;
    }

    public function setIdcategoriecode(int $idcategoriecode): static
    {
        $this->idcategoriecode = $idcategoriecode;

        return $this;
    }


}
