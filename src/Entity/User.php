<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Pays;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telephone;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datedeNaissance;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datedInscription;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Identifiant;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Adresse", mappedBy="user")
     */
    private $adresse;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Panier", mappedBy="user")
     */
    private $Panier;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $civilite;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PaieCommande", mappedBy="civilite")
     */
    private $Paiement;

    public function __construct()
    {
        $this->adresse = new ArrayCollection();
        $this->Panier = new ArrayCollection();
        $this->Paiement = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): self
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->Pays;
    }

    public function setPays(string $Pays): self
    {
        $this->Pays = $Pays;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getDatedeNaissance(): ?\DateTimeInterface
    {
        return $this->datedeNaissance;
    }

    public function setDatedeNaissance(\DateTimeInterface $datedeNaissance): self
    {
        $this->datedeNaissance = $datedeNaissance;

        return $this;
    }

    public function getDatedInscription(): ?\DateTimeInterface
    {
        return $this->datedInscription;
    }

    public function setDatedInscription(\DateTimeInterface $datedInscription): self
    {
        $this->datedInscription = $datedInscription;

        return $this;
    }

    public function getIdentifiant(): ?string
    {
        return $this->Identifiant;
    }

    public function setIdentifiant(string $Identifiant): self
    {
        $this->Identifiant = $Identifiant;

        return $this;
    }

    /**
     * @return Collection|Adresse[]
     */
    public function getAdresse(): Collection
    {
        return $this->adresse;
    }

    public function addAdresse(Adresse $adresse): self
    {
        if (!$this->adresse->contains($adresse)) {
            $this->adresse[] = $adresse;
            $adresse->setUser($this);
        }

        return $this;
    }

    public function removeAdresse(Adresse $adresse): self
    {
        if ($this->adresse->contains($adresse)) {
            $this->adresse->removeElement($adresse);
            // set the owning side to null (unless already changed)
            if ($adresse->getUser() === $this) {
                $adresse->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Panier[]
     */
    public function getPanier(): Collection
    {
        return $this->Panier;
    }

    public function addPanier(Panier $panier): self
    {
        if (!$this->Panier->contains($panier)) {
            $this->Panier[] = $panier;
            $panier->setUser($this);
        }

        return $this;
    }

    public function removePanier(Panier $panier): self
    {
        if ($this->Panier->contains($panier)) {
            $this->Panier->removeElement($panier);
            // set the owning side to null (unless already changed)
            if ($panier->getUser() === $this) {
                $panier->setUser(null);
            }
        }

        return $this;
    }

    public function getCivilite(): ?bool
    {
        return $this->civilite;
    }

    public function setCivilite(?bool $civilite): self
    {
        $this->civilite = $civilite;

        return $this;
    }

    /**
     * @return Collection|PaieCommande[]
     */
    public function getPaiement(): Collection
    {
        return $this->Paiement;
    }

    public function addPaiement(PaieCommande $paiement): self
    {
        if (!$this->Paiement->contains($paiement)) {
            $this->Paiement[] = $paiement;
            $paiement->setCivilite($this);
        }

        return $this;
    }

    public function removePaiement(PaieCommande $paiement): self
    {
        if ($this->Paiement->contains($paiement)) {
            $this->Paiement->removeElement($paiement);
            // set the owning side to null (unless already changed)
            if ($paiement->getCivilite() === $this) {
                $paiement->setCivilite(null);
            }
        }

        return $this;
    }
}
