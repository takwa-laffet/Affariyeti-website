<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 *
 * @ORM\Table(name="user" ,uniqueConstraints={@ORM\UniqueConstraint(columns={"email"})})
 * @ORM\Entity
 * @Orm\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User  implements UserInterface
{
 
 /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
        private $id;

   /**
 * @ORM\Column(length=255, nullable=true)
 */

private ?string $email = null;

/**
 * @ORM\Column(length=255, nullable=true)
 */
private ?string $nom = null;

/**
 * @ORM\Column(length=255, nullable=true)
 */
private ?string $prenom = null;

/**
 * @ORM\Column(length=255, nullable=true)
 */
private ?string $mdp = null;

/**
 * @ORM\Column(length=255, nullable=true)
 */
private ?string $verificationcode = null;

/**
 * @ORM\Column(length=255, nullable=true)
 */
private ?string $role = null;

/**
 * @ORM\Column(type="boolean", nullable=true)
 */
private ?bool $status = null;
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp): static
    {
        $this->mdp = $mdp;

        return $this;
    }

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(?bool $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getVerificationcode(): ?string
    {
        return $this->verificationcode;
    }

    public function setVerificationcode(string $verificationcode): static
    {
        $this->verificationcode = $verificationcode;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): static
    {
        $this->role = $role;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->mdp;
    }

    public function setPassword(string $password): static
    {
        $this->mdp = $password;

        return $this;
    }
    public function getRoles(): array
    {
        return [$this->role];
    }

    public function getSalt(): ?string
    {
        // You can leave this method blank or return a salt
        return null;
    }

    public function getUsername(): ?string
    {
        return $this->email;
    }

    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
    public function getIdentifier():string
    {
        return $this->email;
    }
    public function getUserIdentifier():string
    {
        return $this->email;
    }
}
