<?php

namespace App\Entity;

use App\Repository\OffreDislikeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OffreDislikeRepository::class)]
class OffreDislike
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Offre::class, inversedBy: 'dislikes', fetch: 'EAGER')]
    #[ORM\JoinColumn(nullable: false)]
    private $offre;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'offreDislikes')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOffre(): ?Offre
    {
        return $this->offre;
    }

    public function setOffre(?Offre $offre): self
    {
        $this->offre = $offre;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
