<?php

namespace App\Entity;

use App\Repository\EmployeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployeRepository::class)]
class Employe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $departement = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $poste = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $amco = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photo = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $genre = null;

    #[ORM\ManyToMany(targetEntity: BaseAutorisation::class, mappedBy: 'employe', cascade: ['remove'])]
    private Collection $baseAutorisations;

    #[ORM\OneToOne(mappedBy: 'employe' , cascade: ['remove'])]
    private ?NumeroHabilitation $numeroHabilitation = null;
    #[ORM\OneToMany(mappedBy: 'employe', targetEntity: Document::class, cascade: ['persist', 'remove'])]
    private Collection $documents;

    public function __construct()
    {
        $this->baseAutorisations = new ArrayCollection();
        $this->documents = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDepartement(): ?string
    {
        return $this->departement;
    }

    public function setDepartement(?string $departement): self
    {
        $this->departement = $departement;

        return $this;
    }

    public function getPoste(): ?string
    {
        return $this->poste;
    }

    public function setPoste(?string $poste): self
    {
        $this->poste = $poste;

        return $this;
    }

    public function getAmco(): ?\DateTime
    {
        return $this->amco;
    }

    public function setAmco(?\DateTime $amco): self
    {
        $this->amco = $amco;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(?string $genre): self
    {
        $this->genre = $genre;

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
            $baseAutorisation->addEmploye($this);
        }

        return $this;
    }

    public function removeBaseAutorisation(BaseAutorisation $baseAutorisation): self
    {
        if ($this->baseAutorisations->removeElement($baseAutorisation)) {
            $baseAutorisation->removeEmploye($this);
        }

        return $this;
    }


    public function getNumeroHabilitation(): ?NumeroHabilitation
    {
        return $this->numeroHabilitation;
    }

    public function setNumeroHabilitation(?NumeroHabilitation $numeroHabilitation): self
    {
        // unset the owning side of the relation if necessary
        if ($numeroHabilitation === null && $this->numeroHabilitation !== null) {
            $this->numeroHabilitation->setEmploye(null);
        }

        // set the owning side of the relation if necessary
        if ($numeroHabilitation !== null && $numeroHabilitation->getEmploye() !== $this) {
            $numeroHabilitation->setEmploye($this);
        }

        $this->numeroHabilitation = $numeroHabilitation;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getNom() . ' ' . $this->getPrenom();
    }

    /**
     * @return Collection<int, Document>
     */
    public function getDocuments(): Collection
    {
        return $this->documents;
    }

    public function addDocument(Document $document): self
    {
        if (!$this->documents->contains($document)) {
            $this->documents->add($document);
            $document->setEmploye($this);
        }

        return $this;
    }

    public function removeDocument(Document $document): self
    {
        if ($this->documents->removeElement($document)) {
// set the owning side to null (unless already changed)
            if ($document->getEmploye() === $this) {
                $document->setEmploye(null);
            }
        }

        return $this;
    }
}
