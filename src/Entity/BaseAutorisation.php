<?php

namespace App\Entity;

use App\Repository\BaseAutorisationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BaseAutorisationRepository::class)]
class BaseAutorisation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $CreatedAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $EndedAt = null;

    #[ORM\ManyToMany(targetEntity: Diplome::class, inversedBy: 'baseAutorisations')]
    private Collection $Diplome;

    #[ORM\ManyToMany(targetEntity: Centre::class, inversedBy: 'baseAutorisations')]
    private Collection $Centre;

    #[ORM\ManyToMany(targetEntity: Employe::class, inversedBy: 'baseAutorisations')]
    private Collection $Employe;

    public function __construct()
    {
        $this->Diplome = new ArrayCollection();
        $this->Centre = new ArrayCollection();
        $this->Employe = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->CreatedAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $CreatedAt): self
    {
        $this->CreatedAt = $CreatedAt;

        return $this;
    }

    public function getEndedAt(): ?\DateTimeImmutable
    {
        return $this->EndedAt;
    }

    public function setEndedAt(?\DateTimeImmutable $EndedAt): self
    {
        $this->EndedAt = $EndedAt;

        return $this;
    }

    /**
     * @return Collection<int, Diplome>
     */
    public function getDiplome(): Collection
    {
        return $this->Diplome;
    }

    public function addDiplome(Diplome $diplome): self
    {
        if (!$this->Diplome->contains($diplome)) {
            $this->Diplome->add($diplome);
        }

        return $this;
    }

    public function removeDiplome(Diplome $diplome): self
    {
        $this->Diplome->removeElement($diplome);

        return $this;
    }

    /**
     * @return Collection<int, Centre>
     */
    public function getCentre(): Collection
    {
        return $this->Centre;
    }

    public function addCentre(Centre $centre): self
    {
        if (!$this->Centre->contains($centre)) {
            $this->Centre->add($centre);
        }

        return $this;
    }

    public function removeCentre(Centre $centre): self
    {
        $this->Centre->removeElement($centre);

        return $this;
    }

    /**
     * @return Collection<int, Employe>
     */
    public function getEmploye(): Collection
    {
        return $this->Employe;
    }

    public function addEmploye(Employe $employe): self
    {
        if (!$this->Employe->contains($employe)) {
            $this->Employe->add($employe);
        }

        return $this;
    }

    public function removeEmploye(Employe $employe): self
    {
        $this->Employe->removeElement($employe);

        return $this;
    }
}
