<?php

namespace App\Entity;

use App\Repository\VoituresRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VoituresRepository::class)]
class Voitures
{
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: "App\Entity\User", inversedBy: "voitures")]
    #[ORM\JoinColumn(name: "user_id", referencedColumnName: "id")]
    private $user;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank]
    private ?string $marque = null;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank]
    private ?string $model = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?int $annee = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?int $km = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank]
    private ?string $energie = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank]
    private ?string $vitesse = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $prix = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $car1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $car2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $car3 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $car4 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $car5 = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): static
    {
        $this->marque = $marque;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    public function setAnnee(int $annee): static
    {
        $this->annee = $annee;

        return $this;
    }

    public function getKm(): ?int
    {
        return $this->km;
    }

    public function setKm(int $km): static
    {
        $this->km = $km;

        return $this;
    }

    public function getEnergie(): ?string
    {
        return $this->energie;
    }

    public function setEnergie(string $energie): static
    {
        $this->energie = $energie;

        return $this;
    }

    public function getVitesse(): ?string
    {
        return $this->vitesse;
    }

    public function setVitesse(string $vitesse): static
    {
        $this->vitesse = $vitesse;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getCar1(): ?string
    {
        return $this->car1;
    }

    public function setCar1(?string $car1): static
    {
        $this->car1 = $car1;

        return $this;
    }

    public function getCar2(): ?string
    {
        return $this->car2;
    }

    public function setCar2(?string $car2): static
    {
        $this->car2 = $car2;

        return $this;
    }

    public function getCar3(): ?string
    {
        return $this->car3;
    }

    public function setCar3(?string $car3): static
    {
        $this->car3 = $car3;

        return $this;
    }

    public function getCar4(): ?string
    {
        return $this->car4;
    }

    public function setCar4(?string $car4): static
    {
        $this->car4 = $car4;

        return $this;
    }

    public function getCar5(): ?string
    {
        return $this->car5;
    }

    public function setCar5(?string $car5): static
    {
        $this->car5 = $car5;

        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user): self
    {
        $this->user = $user;

        return $this;
    }
}
