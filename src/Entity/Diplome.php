<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
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

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $categorie = null;

    #[ORM\Column(nullable: true)]
    private ?string $validite = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type = null;

    #[ORM\Column(length: 255, nullable: true, unique: true)]
    #[Gedmo\Slug(fields: ["type", "nom" , "categorie"])]
    private ?string $template = null;

    #[ORM\ManyToMany(targetEntity: BaseAutorisation::class, mappedBy: 'diplome')]
    private Collection $baseAutorisations;


    public function __construct()
    {
        $this->baseAutorisations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(?string $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

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

    /**
     * Get the value of template
     */
    public function getTemplate(): ?string
    {
        return $this->template;
    }

    /**
     * Set the value of template
     *
     * @return  self
     */
    public function setTemplate(?string $template): self
    {
        $this->template = $template;

        return $this;
    }

    /**
     * @ORM\PrePersist()
     */
    public function setTemplateValue(): void
    {
        $this->template = $this->type . '-' . $this->nom . '-' . $this->categorie;
    }

    public function __toString()
    {
        return $this->type . '-' . $this->nom . '-' . $this->categorie;
    }
}
