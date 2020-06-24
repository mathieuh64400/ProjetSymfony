<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EcoscoreRepository")
 */
class Ecoscore
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $valeur;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Article", mappedBy="ecoscore")
     */
    private $Ecoscore;

    public function __construct()
    {
        $this->Ecoscore = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValeur(): ?string
    {
        return $this->valeur;
    }

    public function setValeur(string $valeur): self
    {
        $this->valeur = $valeur;

        return $this;
    }

    /**
     * @return Collection|Article[]
     */
    public function getEcoscore(): Collection
    {
        return $this->Ecoscore;
    }

    public function addEcoscore(Article $ecoscore): self
    {
        if (!$this->Ecoscore->contains($ecoscore)) {
            $this->Ecoscore[] = $ecoscore;
            $ecoscore->setEcoscore($this);
        }

        return $this;
    }

    public function removeEcoscore(Article $ecoscore): self
    {
        if ($this->Ecoscore->contains($ecoscore)) {
            $this->Ecoscore->removeElement($ecoscore);
            // set the owning side to null (unless already changed)
            if ($ecoscore->getEcoscore() === $this) {
                $ecoscore->setEcoscore(null);
            }
        }

        return $this;
    }
}
