<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ChoixCommandeRepository")
 */
class ChoixCommande
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $detail;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\NatureCommande", inversedBy="ChoixCommande")
     */
    private $natureCommande;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Nature", inversedBy="Commande")
     */
    private $nature;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDetail(): ?string
    {
        return $this->detail;
    }

    public function setDetail(?string $detail): self
    {
        $this->detail = $detail;

        return $this;
    }

    public function getNatureCommande(): ?NatureCommande
    {
        return $this->natureCommande;
    }

    public function setNatureCommande(?NatureCommande $natureCommande): self
    {
        $this->natureCommande = $natureCommande;

        return $this;
    }

    public function getNature(): ?Nature
    {
        return $this->nature;
    }

    public function setNature(?Nature $nature): self
    {
        $this->nature = $nature;

        return $this;
    }
}
