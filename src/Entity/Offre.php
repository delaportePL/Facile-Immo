<?php

namespace App\Entity;

use App\Repository\OffreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OffreRepository::class)]
class Offre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $prix;

    #[ORM\Column(type: 'string', length: 50)]
    private $type;

    #[ORM\Column(type: 'smallint')]
    private $superficie;

    #[ORM\Column(type: 'smallint')]
    private $etage;

    #[ORM\Column(type: 'smallint')]
    private $etageTotal;

    #[ORM\Column(type: 'smallint')]
    private $piece;

    #[ORM\Column(type: 'smallint')]
    private $chambre;

    #[ORM\Column(type: 'smallint')]
    private $salleDeBain;

    #[ORM\Column(type: 'smallint')]
    private $terrain;

    #[ORM\Column(type: 'boolean')]
    private $garage;

    #[ORM\Column(type: 'boolean')]
    private $cave;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[ORM\OneToMany(mappedBy: 'offre', targetEntity: OffreLike::class, orphanRemoval: true)]
    private $likes;

    #[ORM\OneToMany(mappedBy: 'offre', targetEntity: OffreDislike::class, orphanRemoval: true)]
    private $dislikes;

    #[ORM\Column(type: 'float')]
    private $latitude;

    #[ORM\Column(type: 'float')]
    private $longitude;

    public function __construct()
    {
        $this->likes = new ArrayCollection();
        $this->dislikes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getEtage(): ?int
    {
        return $this->etage;
    }

    public function setEtage(int $etage): self
    {
        $this->etage = $etage;

        return $this;
    }

    public function getEtageTotal(): ?int
    {
        return $this->etageTotal;
    }

    public function setEtageTotal(int $etageTotal): self
    {
        $this->etageTotal = $etageTotal;

        return $this;
    }

    public function getPiece(): ?int
    {
        return $this->piece;
    }

    public function setPiece(int $piece): self
    {
        $this->piece = $piece;

        return $this;
    }

    public function getChambre(): ?int
    {
        return $this->chambre;
    }

    public function setChambre(int $chambre): self
    {
        $this->chambre = $chambre;

        return $this;
    }

    public function getSuperficie(): ?int
    {
        return $this->superficie;
    }

    public function setSuperficie(int $superficie): self
    {
        $this->superficie = $superficie;

        return $this;
    }

    public function getTerrain(): ?int
    {
        return $this->terrain;
    }

    public function setTerrain(int $terrain): self
    {
        $this->terrain = $terrain;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSalleDeBain(): ?int
    {
        return $this->salleDeBain;
    }

    public function setSalleDeBain(int $salleDeBain): self
    {
        $this->salleDeBain = $salleDeBain;

        return $this;
    }

    public function getGarage(): ?bool
    {
        return $this->garage;
    }

    public function setGarage(bool $garage): self
    {
        $this->garage = $garage;

        return $this;
    }

    public function isCave(): ?bool
    {
        return $this->cave;
    }

    public function setCave(bool $cave): self
    {
        $this->cave = $cave;

        return $this;
    }

    /**
     * @return Collection<int, OffreLike>
     */
    public function getLikes(): Collection
    {
        return $this->likes;
    }

    public function addLike(OffreLike $like): self
    {
        if (!$this->likes->contains($like)) {
            $this->likes[] = $like;
            $like->setOffre($this);
        }

        return $this;
    }

    public function removeLike(OffreLike $like): self
    {
        if ($this->likes->removeElement($like)) {
            // set the owning side to null (unless already changed)
            if ($like->getOffre() === $this) {
                $like->setOffre(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, OffreDislike>
     */
    public function getDislikes(): Collection
    {
        return $this->dislikes;
    }

    public function addDislike(OffreDislike $dislike): self
    {
        if (!$this->dislikes->contains($dislike)) {
            $this->dislikes[] = $dislike;
            $dislike->setOffre($this);
        }

        return $this;
    }

    public function removeDislike(OffreDislike $dislike): self
    {
        if ($this->dislikes->removeElement($dislike)) {
            // set the owning side to null (unless already changed)
            if ($dislike->getOffre() === $this) {
                $dislike->setOffre(null);
            }
        }

        return $this;
    }


    public function isLikedByUser(User $user) : bool 
    {
        foreach($this->likes as $like){
            if($like->getUser() === $user) return true;
        }

        return false;
    }

    public function isDislikedByUser(User $user) : bool 
    {
        foreach($this->dislikes as $dislike){
            if($dislike->getUser() === $user) return true;
        }

        return false;

    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }
}
