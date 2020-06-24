<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NatureRepository")
 */
class Nature
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
     * @ORM\OneToMany(targetEntity="App\Entity\Evenement", mappedBy="nature")
     */
    private $Nature;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ChoixCommande", mappedBy="nature")
     */
    private $Commande;

    public function __construct()
    {
        $this->Nature = new ArrayCollection();
        $this->Commande = new ArrayCollection();
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
     * @return Collection|Evenement[]
     */
    public function getNature(): Collection
    {
        return $this->Nature;
    }

    public function addNature(Evenement $nature): self
    {
        if (!$this->Nature->contains($nature)) {
            $this->Nature[] = $nature;
            $nature->setNature($this);
        }

        return $this;
    }

    public function removeNature(Evenement $nature): self
    {
        if ($this->Nature->contains($nature)) {
            $this->Nature->removeElement($nature);
            // set the owning side to null (unless already changed)
            if ($nature->getNature() === $this) {
                $nature->setNature(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ChoixCommande[]
     */
    public function getCommande(): Collection
    {
        return $this->Commande;
    }

    public function addCommande(ChoixCommande $commande): self
    {
        if (!$this->Commande->contains($commande)) {
            $this->Commande[] = $commande;
            $commande->setNature($this);
        }

        return $this;
    }

    public function removeCommande(ChoixCommande $commande): self
    {
        if ($this->Commande->contains($commande)) {
            $this->Commande->removeElement($commande);
            // set the owning side to null (unless already changed)
            if ($commande->getNature() === $this) {
                $commande->setNature(null);
            }
        }

        return $this;
    }
}
