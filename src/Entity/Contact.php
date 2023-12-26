<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prénom = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 10)]
    private ?string $téléphone = null;

    #[ORM\OneToMany(mappedBy: 'contact', targetEntity: Licencie::class)]
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

    public function getPrénom(): ?string
    {
        return $this->prénom;
    }

    public function setPrénom(string $prénom): static
    {
        $this->prénom = $prénom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getTéléphone(): ?string
    {
        return $this->téléphone;
    }

    public function setTéléphone(string $téléphone): static
    {
        $this->téléphone = $téléphone;

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
            $licencie->setContact($this);
        }

        return $this;
    }

    public function removeLicencie(Licencie $licencie): static
    {
        if ($this->licencie->removeElement($licencie)) {
            // set the owning side to null (unless already changed)
            if ($licencie->getContact() === $this) {
                $licencie->setContact(null);
            }
        }

        return $this;
    }
}
