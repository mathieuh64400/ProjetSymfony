<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass="App\Repository\PaieCommandeRepository")
 */
class PaieCommande
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $mode;

    /**
     * @ORM\Column(type="boolean")
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min = 16, max = 16)
     */
    private $numeroCB;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateExpiration;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;
   /**
     * @ORM\Column(type="string", length=255)
     */
    private $etat;
    /**
     * @ORM\Column(type="string", length=255)
     * 
     */
    private $Cryptogramme;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $status;

 

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="Paiement")
     */
    private $civilite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMode(): ?bool
    {
        return $this->mode;
    }

    public function setMode(bool $mode): self
    {
        $this->mode = $mode;

        return $this;
    }

    public function getAdresse(): ?bool
    {
        return $this->adresse;
    }

    public function setAdresse(bool $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getNumeroCB(): ?string
    {
        return $this->numeroCB;
    }

    public function setNumeroCB(string $numeroCB): self
    {
        $this->numeroCB = $numeroCB;

        return $this;
    }

    public function getDateExpiration(): ?\DateTimeInterface
    {
        return $this->dateExpiration;
    }

    public function setDateExpiration(\DateTimeInterface $dateExpiration): self
    {
        $this->dateExpiration = $dateExpiration;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getCryptogramme(): ?string
    {
        return $this->Cryptogramme;
    }

    public function setCryptogramme(string $Cryptogramme): self
    {
        $this->Cryptogramme = $Cryptogramme;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(?bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getCivilite(): ?User
    {
        return $this->civilite;
    }

    public function setCivilite(?User $civilite): self
    {
        $this->civilite = $civilite;

        return $this;
    }
}
