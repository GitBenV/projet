<?php

namespace App\Entity;

use App\Repository\CampusRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CampusRepository::class)
 */
class Campus
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
    private $nomcampus;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomcampus(): ?string
    {
        return $this->nomcampus;
    }

    public function setNomcampus(string $nomcampus): self
    {
        $this->nomcampus = $nomcampus;

        return $this;
    }
}
