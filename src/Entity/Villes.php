<?php

namespace App\Entity;

use App\Repository\VillesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VillesRepository::class)
 */
class Villes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomville;

    /**
     * @ORM\Column(type="integer")
     */
    private $codepostal;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomville(): ?string
    {
        return $this->nomville;
    }

    public function setNomville(string $nomville): self
    {
        $this->nomville = $nomville;

        return $this;
    }

    public function getCodepostal(): ?int
    {
        return $this->codepostal;
    }

    public function setCodepostal(int $codepostal): self
    {
        $this->codepostal = $codepostal;

        return $this;
    }
}
