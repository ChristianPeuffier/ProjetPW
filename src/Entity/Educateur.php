<?php

namespace App\Entity;

use App\Repository\EducateurRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EducateurRepository::class)]
class Educateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'L\'email est obligatoire.')]
    #[Assert\Email(message: 'L\'email n\'est pas valide.')]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Le mot de passe est obligatoire.')]
    #[Assert\Length(min: 8, minMessage: 'Le mot de passe doit contenir au moins {{ limit }} caractères.')]
    #[Assert\Regex(pattern: '/[a-z]/', message: 'Le mot de passe doit contenir au moins une minuscule.')]
    #[Assert\Regex(pattern: '/[A-Z]/', message: 'Le mot de passe doit contenir au moins une majuscule.')]
    #[Assert\Regex(pattern: '/[0-9]/', message: 'Le mot de passe doit contenir au moins un chiffre.')]
    private ?string $password = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Licencie $licencie = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getLicencie(): ?Licencie
    {
        return $this->licencie;
    }

    public function setLicencie(Licencie $licencie): static
    {
        $this->licencie = $licencie;

        return $this;
    }
}
