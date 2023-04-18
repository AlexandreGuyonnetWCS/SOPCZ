<?php

namespace App\Entity;

use App\Repository\BaseAutorisationRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;

#[ORM\Entity(repositoryClass: BaseAutorisationRepository::class)]
class BaseAutorisation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $endedAt = null;

    #[ORM\ManyToMany(targetEntity: Centre::class, inversedBy: 'baseAutorisations')]
    private Collection $centre;

    #[ORM\ManyToMany(targetEntity: Employe::class, inversedBy: 'baseAutorisations')]
    private Collection $employe;

    #[ORM\ManyToMany(targetEntity: DiplomeFull::class, inversedBy: 'baseAutorisations')]
    private Collection $diplome;


    public function __construct()
    {
        $this->centre = new ArrayCollection();
        $this->employe = new ArrayCollection();
        $this->diplome = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getEndedAt(): ?\DateTimeImmutable
    {
        return $this->endedAt;
    }

    public function setEndedAt(?\DateTimeImmutable $endedAt): self
    {
        if ($endedAt) {
            $this->endedAt = $endedAt;
        } else {
            $this->endedAt = $endedAt;
            $validite = $this->getDiplome()?->getValues()[0]?->getValidite() ?? 0;
            $this->endedAt = $this->getCreatedAt()->modify('+' . $validite . ' year');
        }
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

    /**
     * @return Collection<int, Employe>
     */
    public function getEmploye(): Collection
    {
        return $this->employe;
    }

    public function addEmploye(Employe $employe): self
    {
        if (!$this->employe->contains($employe)) {
            $this->employe->add($employe);
        }

        return $this;
    }

    public function removeEmploye(Employe $employe): self
    {
        $this->employe->removeElement($employe);

        return $this;
    }


    /**
     * @return Collection<int, DiplomeFull>
     */
    public function getDiplome(): Collection
    {
        return $this->diplome;
    }

    public function addDiplome(DiplomeFull $diplome): self
    {
        if (!$this->diplome->contains($diplome)) {
            $this->diplome->add($diplome);
        }

        return $this;
    }

    public function removeDiplome(DiplomeFull $diplome): self
    {
        $this->diplome->removeElement($diplome);

        return $this;
    }
}
