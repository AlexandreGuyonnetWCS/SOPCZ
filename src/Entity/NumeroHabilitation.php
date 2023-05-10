<?php

namespace App\Entity;

use App\Repository\NumeroHabilitationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NumeroHabilitationRepository::class)]
class NumeroHabilitation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $number = null;

    #[ORM\OneToOne(inversedBy: 'numeroHabilitation', cascade: ['persist', 'remove'])]
    private ?Employe $employe = null;

    #[ORM\ManyToMany(targetEntity: Centre::class, inversedBy: 'numeroHabilitations')]
    private Collection $centre;

    public function __construct()
    {
        $this->centre = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(?string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getEmploye(): ?Employe
    {
        return $this->employe;
    }

    public function setEmploye(?Employe $employe): self
    {
        $this->employe = $employe;

        return $this;
    }

    /**
     * @return Collection<int, Centre>
     */
    public function getCentre(): Collection
    {
        return $this->centre;
    }

    public function addCentre(Centre $centre): self
    {
        if (!$this->centre->contains($centre)) {
            $this->centre->add($centre);
        }

        return $this;
    }

    public function removeCentre(Centre $centre): self
    {
        $this->centre->removeElement($centre);

        return $this;
    }
}
