<?php

namespace App\Entity;

use App\Repository\LicencieRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: LicencieRepository::class)]
class Licencie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::SMALLINT,unique: true)]
    #[Assert\Positive(message: 'Le numéro de licence doit être un nombre positif.')]
    private ?int $numeroLicence = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Le nom est obligatoire.')]
    private ?string $nom = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message: 'Le prénom est obligatoire.')]
    private ?string $prenom = null;

    #[ORM\OneToMany(mappedBy: 'licencie', targetEntity: Categorie::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?categorie $categorie = null;

    #[ORM\ManyToOne(inversedBy: 'licencie')]
    #[ORM\JoinColumn(nullable: true,onDelete: 'SET NULL')]
    private ?contact $contact = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroLicence(): ?int
    {
        return $this->numeroLicence;
    }

    public function setNumeroLicence(int $numéroLicence): static
    {
        $this->numeroLicence = $numéroLicence;

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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

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
