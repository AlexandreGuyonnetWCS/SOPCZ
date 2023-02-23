<?php

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntrepriseRepository::class)]
class Entreprise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Adresse = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $CodePostal = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $logo = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Ville = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $NomDirecteur = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $PrenomDirecteur = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $SignatureDirecteur = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Siret = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Contacte = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $GenreDirecteur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(?string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(?string $Adresse): self
    {
        $this->Adresse = $Adresse;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->CodePostal;
    }

    public function setCodePostal(?string $CodePostal): self
    {
        $this->CodePostal = $CodePostal;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->Ville;
    }

    public function setVille(?string $Ville): self
    {
        $this->Ville = $Ville;

        return $this;
    }

    public function getNomDirecteur(): ?string
    {
        return $this->NomDirecteur;
    }

    public function setNomDirecteur(?string $NomDirecteur): self
    {
        $this->NomDirecteur = $NomDirecteur;

        return $this;
    }

    public function getPrenomDirecteur(): ?string
    {
        return $this->PrenomDirecteur;
    }

    public function setPrenomDirecteur(?string $PrenomDirecteur): self
    {
        $this->PrenomDirecteur = $PrenomDirecteur;

        return $this;
    }

    public function getSignatureDirecteur(): ?string
    {
        return $this->SignatureDirecteur;
    }

    public function setSignatureDirecteur(?string $SignatureDirecteur): self
    {
        $this->SignatureDirecteur = $SignatureDirecteur;

        return $this;
    }

    public function getSiret(): ?string
    {
        return $this->Siret;
    }

    public function setSiret(?string $Siret): self
    {
        $this->Siret = $Siret;

        return $this;
    }

    public function getContacte(): ?string
    {
        return $this->Contacte;
    }

    public function setContacte(?string $Contacte): self
    {
        $this->Contacte = $Contacte;

        return $this;
    }

    public function getGenreDirecteur(): ?string
    {
        return $this->GenreDirecteur;
    }

    public function setGenreDirecteur(?string $GenreDirecteur): self
    {
        $this->GenreDirecteur = $GenreDirecteur;

        return $this;
    }
}
