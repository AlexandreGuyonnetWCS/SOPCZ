<?php

namespace App\Entity;

use App\Repository\DiplomeFullRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DiplomeFullRepository::class)]
class DiplomeFull
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $validite = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\ManyToMany(targetEntity: BaseAutorisation::class, mappedBy: 'diplome')]
    private Collection $baseAutorisations;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $diplomeType = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $diplomeName = null;

    #[ORM\Column(length: 255)]
    private ?string $diplomeCategory = null;

    public function __construct()
    {
        $this->baseAutorisations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDiplomeType(): ?string
    {
        return $this->diplomeType;
    }

    public function setDiplomeType(?string $diplomeType): self
    {
        $this->diplomeType = $diplomeType;

        return $this;
    }

    public function getDiplomeName(): ?string
    {
        return $this->diplomeName;
    }

    public function setDiplomeName(?string $diplomeName): self
    {
        $this->diplomeName = $diplomeName;

        return $this;
    }

    public function getDiplomeCategory(): ?string
    {
        return $this->diplomeCategory;
    }

    public function setDiplomeCategory(string $diplomeCategory): self
    {
        $this->diplomeCategory = $diplomeCategory;

        return $this;
    }

    public function getValidite(): ?int
    {
        return $this->validite;
    }

    public function setValidite(?int $validite): self
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

    public function __toString(): string
    {
        return $this->getDiplomeType() . ' ' . $this->getDiplomeName() . ' ' . $this->getDiplomeCategory();
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
}
