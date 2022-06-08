<?php

namespace App\Entity;

use App\Repository\OffreRepository;
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
    private $toilette;

    #[ORM\Column(type: 'smallint')]
    private $terrain;

    #[ORM\Column(type: 'integer')]
    private $terrasse;

    #[ORM\Column(type: 'integer')]
    private $balcon;

    #[ORM\Column(type: 'boolean')]
    private $garage;

    #[ORM\Column(type: 'boolean')]
    private $cave;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

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

    public function getToilette(): ?int
    {
        return $this->toilette;
    }

    public function setToilette(int $toilette): self
    {
        $this->toilette = $toilette;

        return $this;
    }

    public function getTerrasse(): ?int
    {
        return $this->terrasse;
    }

    public function setTerrasse(int $terrasse): self
    {
        $this->terrasse = $terrasse;

        return $this;
    }

    public function getBalcon(): ?int
    {
        return $this->balcon;
    }

    public function setBalcon(int $balcon): self
    {
        $this->balcon = $balcon;

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
}