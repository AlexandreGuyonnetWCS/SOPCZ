<?php

namespace App\Entity;

use App\Repository\DiplomeCategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DiplomeCategorieRepository::class)]
class DiplomeCategorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: DiplomeFull::class)]
    private Collection $diplomeFulls;

    public function __construct()
    {
        $this->diplomeFulls = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, DiplomeFull>
     */
    public function getDiplomeFulls(): Collection
    {
        return $this->diplomeFulls;
    }

    public function addDiplomeFull(DiplomeFull $diplomeFull): self
    {
        if (!$this->diplomeFulls->contains($diplomeFull)) {
            $this->diplomeFulls->add($diplomeFull);
            $diplomeFull->setCategorie($this);
        }

        return $this;
    }

    public function removeDiplomeFull(DiplomeFull $diplomeFull): self
    {
        if ($this->diplomeFulls->removeElement($diplomeFull)) {
            // set the owning side to null (unless already changed)
            if ($diplomeFull->getCategorie() === $this) {
                $diplomeFull->setCategorie(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
