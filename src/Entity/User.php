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

    #[ORM\OneToMany(mappedBy: 'User', targetEntity: LikedOffre::class, orphanRemoval: true)]
    private $LikedOffre;

    public function __construct()
    {
        $this->LikedOffre = new ArrayCollection();
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
     * @return Collection<int, LikedOffre>
     */
    public function getLikedOffre(): Collection
    {
        return $this->LikedOffre;
    }

    public function addLikedOffre(LikedOffre $likedOffre): self
    {
        if (!$this->LikedOffre->contains($likedOffre)) {
            $this->LikedOffre[] = $likedOffre;
            $likedOffre->setUser($this);
        }

        return $this;
    }

    public function removeLikedOffre(LikedOffre $likedOffre): self
    {
        if ($this->LikedOffre->removeElement($likedOffre)) {
            // set the owning side to null (unless already changed)
            if ($likedOffre->getUser() === $this) {
                $likedOffre->setUser(null);
            }
        }

        return $this;
    }
}
