<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
<<<<<<< Updated upstream
=======

>>>>>>> Stashed changes
/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 */
class User
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
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="mdp", type="string", length=255, nullable=false)
     */
    private $mdp;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="status", type="boolean", nullable=true)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=25, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=30, nullable=false)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="verificationCode", type="string", length=300, nullable=false)
     */
    private $verificationcode;

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=300, nullable=false)
     */
    private $role;
<<<<<<< Updated upstream
    public function __toString(): string
    {
        return $this->nom . ' ' . $this->prenom; // Or any other meaningful representation
    }
=======

>>>>>>> Stashed changes

}
