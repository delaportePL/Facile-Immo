<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'Cette adresse email est déjà utilisée, veuillez en sélectionner une autre ou vous connecter.')]
#[UniqueEntity(fields: ['email'], message: 'Cette adresse email est déjà utilisée, veuillez en sélectionner une autre ou vous connecter.')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $email;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type: 'string')]
    private $password;

    #[ORM\Column(type: 'string', length: 150)]
    private $nom;

    #[ORM\Column(type: 'string', length: 150)]
    private $prenom;

    #[ORM\Column(type: 'string', length: 30)]
    private $telephone;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: OffreLike::class, orphanRemoval: true)]
    private $offreLikes;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: OffreDislike::class, orphanRemoval: true)]
    private $offreDislikes;

    public function __construct()
    {
        $this->offreLikes = new ArrayCollection();
        $this->offreDislikes = new ArrayCollection();
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
    public function getUserIdentifier(): string
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
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
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
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

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

    /**
     * @return Collection<int, OffreLike>
     */
    public function getOffreLikes(): Collection
    {
        return $this->offreLikes;
    }

    public function addOffreLike(OffreLike $offreLike): self
    {
        if (!$this->offreLikes->contains($offreLike)) {
            $this->offreLikes[] = $offreLike;
            $offreLike->setUser($this);
        }

        return $this;
    }

    public function removeOffreLike(OffreLike $offreLike): self
    {
        if ($this->offreLikes->removeElement($offreLike)) {
            // set the owning side to null (unless already changed)
            if ($offreLike->getUser() === $this) {
                $offreLike->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, OffreDislike>
     */
    public function getOffreDislikes(): Collection
    {
        return $this->offreDislikes;
    }

    public function addOffreDislike(OffreDislike $offreDislike): self
    {
        if (!$this->offreDislikes->contains($offreDislike)) {
            $this->offreDislikes[] = $offreDislike;
            $offreDislike->setUser($this);
        }

        return $this;
    }

    public function removeOffreDislike(OffreDislike $offreDislike): self
    {
        if ($this->offreDislikes->removeElement($offreDislike)) {
            // set the owning side to null (unless already changed)
            if ($offreDislike->getUser() === $this) {
                $offreDislike->setUser(null);
            }
        }

        return $this;
    }


}
