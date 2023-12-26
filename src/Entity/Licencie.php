<?php

namespace App\Entity;

use App\Repository\LicencieRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LicencieRepository::class)]
class Licencie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::SMALLINT,unique: true)]
    private ?int $numéroLicence = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prénom = null;

    #[ORM\OneToOne(inversedBy: 'licencie')]
    #[ORM\JoinColumn(nullable: false)]
    private ?categorie $categorie = null;

    #[ORM\ManyToOne(inversedBy: 'licencie')]
    #[ORM\JoinColumn(nullable: false)]
    private ?contact $contact = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNuméroLicence(): ?int
    {
        return $this->numéroLicence;
    }

    public function setNuméroLicence(int $numéroLicence): static
    {
        $this->numéroLicence = $numéroLicence;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrénom(): ?string
    {
        return $this->prénom;
    }

    public function setPrénom(string $prénom): static
    {
        $this->prénom = $prénom;

        return $this;
    }

    public function getContact(): ?contact
    {
        return $this->contact;
    }

    public function setContact(?contact $contact): static
    {
        $this->contact = $contact;

        return $this;
    }

    public function getCategorie(): ?categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?categorie $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }
}
