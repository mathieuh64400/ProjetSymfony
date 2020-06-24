<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TotalRepository")
 */
class Total
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $Prix_Panier;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrixPanier(): ?float
    {
        return $this->Prix_Panier;
    }

    public function setPrixPanier(?float $Prix_Panier): self
    {
        $this->Prix_Panier = $Prix_Panier;

        return $this;
    }
}
