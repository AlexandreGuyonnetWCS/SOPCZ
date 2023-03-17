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
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adresse = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $codePostal = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $logo = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ville = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nomDirecteur = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $prenomDirecteur = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $signatureDirecteur = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $siret = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $contacte = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $genreDirecteur = null;

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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(?string $codePostal): self
    {
        $this->codePostal = $codePostal;

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
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getNomDirecteur(): ?string
    {
        return $this->nomDirecteur;
    }

    public function setNomDirecteur(?string $nomDirecteur): self
    {
        $this->nomDirecteur = $nomDirecteur;

        return $this;
    }

    public function getPrenomDirecteur(): ?string
    {
        return $this->prenomDirecteur;
    }

    public function setPrenomDirecteur(?string $prenomDirecteur): self
    {
        $this->prenomDirecteur = $prenomDirecteur;

        return $this;
    }

    public function getSignatureDirecteur(): ?string
    {
        return $this->signatureDirecteur;
    }

    public function setSignatureDirecteur(?string $signatureDirecteur): self
    {
        $this->signatureDirecteur = $signatureDirecteur;

        return $this;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(?string $siret): self
    {
        $this->siret = $siret;

        return $this;
    }

    public function getContacte(): ?string
    {
        return $this->contacte;
    }

    public function setContacte(?string $contacte): self
    {
        $this->contacte = $contacte;

        return $this;
    }

    public function getGenreDirecteur(): ?string
    {
        return $this->genreDirecteur;
    }

    public function setGenreDirecteur(?string $genreDirecteur): self
    {
        $this->genreDirecteur = $genreDirecteur;

        return $this;
    }
}
