<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Le nom est obligatoire.')]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Le code raccourci est obligatoire.')]
    private ?string $code_raccourci = null;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: Licencie::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Collection $licencie;

    public function __construct()
    {
        $this->licencie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCodeRaccourci(): ?string
    {
        return $this->code_raccourci;
    }

    public function setCodeRaccourci(string $code_raccourci): static
    {
        $this->code_raccourci = $code_raccourci;

        return $this;
    }

    public function getLicencie(): ?Collection
    {
        return $this->licencie;
    }

    public function addLicencie(Licencie $licencie): static
    {
        if (!$this->licencie->contains($licencie)) {
            $this->licencie->add($licencie);
            $licencie->setCategorie($this);
        }

        return $this;
    }

    public function removeLicencie(Licencie $licencie): static
    {
        if ($this->licencie->contains($licencie)) {
            $this->licencie->removeElement($licencie);
            if ($licencie->getCategorie() === $this) {
                $licencie->setCategorie(null);
            }
        }

        return $this;
    }
}
