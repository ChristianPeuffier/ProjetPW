<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $code_raccourci = null;

    #[ORM\OneToOne(mappedBy: 'categorie', targetEntity: Licencie::class)]
    private Collection $licencie;

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
    /**
     * @return Collection<int, Licencie>
     */
    public function getLicencie(): Collection
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
        if ($this->licencie->removeElement($licencie)) {
            // set the owning side to null (unless already changed)
            if ($licencie->getCategorie() === $this) {
                $licencie->setCategorie(null);
            }
        }

        return $this;
    }


}
