<?php

namespace App\Entity;

use App\Repository\LikedOffreRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LikedOffreRepository::class)]
class LikedOffre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Offre::class, fetch: "EAGER")]
    #[ORM\JoinColumn(nullable: false)]
    private $Offre;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'LikedOffre')]
    #[ORM\JoinColumn(nullable: false)]
    private $User;

    #[ORM\Column(type: 'boolean')]
    private $Type;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOffre(): ?Offre
    {
        return $this->Offre;
    }

    public function setOffre(?Offre $offre): self
    {
        $this->Offre = $offre;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function isType(): ?bool
    {
        return $this->Type;
    }

    public function setType(bool $Type): self
    {
        $this->Type = $Type;

        return $this;
    }
}
