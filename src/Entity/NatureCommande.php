<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NatureCommandeRepository")
 */
class NatureCommande
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Type;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ChoixCommande", mappedBy="natureCommande")
     */
    private $ChoixCommande;

    public function __construct()
    {
        $this->ChoixCommande = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    /**
     * @return Collection|ChoixCommande[]
     */
    public function getChoixCommande(): Collection
    {
        return $this->ChoixCommande;
    }

    public function addChoixCommande(ChoixCommande $choixCommande): self
    {
        if (!$this->ChoixCommande->contains($choixCommande)) {
            $this->ChoixCommande[] = $choixCommande;
            $choixCommande->setNatureCommande($this);
        }

        return $this;
    }

    public function removeChoixCommande(ChoixCommande $choixCommande): self
    {
        if ($this->ChoixCommande->contains($choixCommande)) {
            $this->ChoixCommande->removeElement($choixCommande);
            // set the owning side to null (unless already changed)
            if ($choixCommande->getNatureCommande() === $this) {
                $choixCommande->setNatureCommande(null);
            }
        }

        return $this;
    }
}
