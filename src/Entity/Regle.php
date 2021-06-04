<?php

namespace App\Entity;

use App\Repository\RegleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RegleRepository::class)
 */
class Regle
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $NbrMax;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbrMax(): ?int
    {
        return $this->NbrMax;
    }

    public function setNbrMax(int $NbrMax): self
    {
        $this->NbrMax = $NbrMax;

        return $this;
    }
}
