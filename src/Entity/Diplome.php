<?php

namespace App\Entity;

use App\Entity\BaseAutorisation;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\DiplomeRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: DiplomeRepository::class)]

class Diplome
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?string $validite = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\ManyToMany(targetEntity: BaseAutorisation::class, mappedBy: 'diplome')]
    private Collection $baseAutorisations;

    #[ORM\OneToOne(inversedBy: 'diplome', cascade: ['persist', 'remove'])]
    private ?DiplomeFull $diplomeFull = null;

    public function __construct()
    {
        $this->baseAutorisations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValidite(): ?string
    {
        return $this->validite;
    }

    public function setValidite(?string $validite): self
    {
        $this->validite = $validite;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, BaseAutorisation>
     */
    public function getBaseAutorisations(): Collection
    {
        return $this->baseAutorisations;
    }

    public function addBaseAutorisation(BaseAutorisation $baseAutorisation): self
    {
        if (!$this->baseAutorisations->contains($baseAutorisation)) {
            $this->baseAutorisations->add($baseAutorisation);
            $baseAutorisation->addDiplome($this);
        }

        return $this;
    }

    public function removeBaseAutorisation(BaseAutorisation $baseAutorisation): self
    {
        if ($this->baseAutorisations->removeElement($baseAutorisation)) {
            $baseAutorisation->removeDiplome($this);
        }

        return $this;
    }

    public function getDiplomeFull(): ?DiplomeFull
    {
        return $this->diplomeFull;
    }

    public function setDiplomeFull(?DiplomeFull $diplomeFull): self
    {
        $this->diplomeFull = $diplomeFull;

        return $this;
    }

    public function __toString()
    {
        return $this->diplomeFull;
    }
}
