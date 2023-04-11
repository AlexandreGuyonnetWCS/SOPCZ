<?php

namespace App\Entity;

use App\Repository\DiplomeFullRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DiplomeFullRepository::class)]
class DiplomeFull
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'diplomeFulls')]
    private ?DiplomeType $type = null;

    #[ORM\ManyToOne(inversedBy: 'diplomeFulls')]
    private ?DiplomeNom $name = null;

    #[ORM\ManyToOne(inversedBy: 'diplomeFulls')]
    private ?DiplomeCategorie $categorie = null;

    #[ORM\OneToOne(mappedBy: 'diplomeFull', cascade: ['persist', 'remove'])]
    private ?Diplome $diplome = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?DiplomeType
    {
        return $this->type;
    }

    public function setType(?DiplomeType $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getName(): ?DiplomeNom
    {
        return $this->name;
    }

    public function setName(?DiplomeNom $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCategorie(): ?DiplomeCategorie
    {
        return $this->categorie;
    }

    public function setCategorie(?DiplomeCategorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getDiplome(): ?Diplome
    {
        return $this->diplome;
    }

    public function setDiplome(?Diplome $diplome): self
    {
        // unset the owning side of the relation if necessary
        if ($diplome === null && $this->diplome !== null) {
            $this->diplome->setDiplomeFull(null);
        }

        // set the owning side of the relation if necessary
        if ($diplome !== null && $diplome->getDiplomeFull() !== $this) {
            $diplome->setDiplomeFull($this);
        }

        $this->diplome = $diplome;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getType() . ' ' . $this->name->getName() . ' ' . $this->categorie->getName();
    }
}
