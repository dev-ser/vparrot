<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity('email')]
#[ORM\Table(name: '`user`')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(targetEntity: "App\Entity\Voitures", mappedBy: "user")]
    private $voitures;

    #[ORM\OneToMany(targetEntity: "App\Entity\Avis", mappedBy: "user")]
    private $avis;

    #[ORM\OneToMany(targetEntity: "App\Entity\Contact", mappedBy: "user")]
    private $contact;

    #[ORM\OneToMany(targetEntity: "App\Entity\Horaires", mappedBy: "user", orphanRemoval: true)]
    private $horaires;

    public function __construct()
    {
        $this->voitures = new ArrayCollection();
        $this->avis = new ArrayCollection();
        $this->contact = new ArrayCollection();
        $this->horaires = new ArrayCollection();
    }

    #[ORM\Column(type:"json")]
    private array $roles = [];

    #[Assert\NotBlank(message: 'Le nom ne peut pas être vide.')]
    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[Assert\NotBlank(message: 'Le prénom ne peut pas être vide.')]
    #[ORM\Column(length: 100)]
    private ?string $prenom = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Assert\Email]
    #[Assert\NotBlank]
    private ?string $email = null;

    #[Assert\Length(min: 12, max: 50, minMessage: 'Ce champ doit avoir au moins 12 caractères.')]
    #[Assert\NotBlank(message: 'Le mot de passe ne peut pas être vide.')]
    #[ORM\Column]
    private ?string $password = null;
    

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function eraseCredentials(): void
    {
        // TODO: Implement eraseCredentials() method.
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

    /**
     * @return Collection<int, Voitures>
     */
    public function getVoitures(): Collection
    {
        return $this->voitures;
    }

    /**
     * @return Collection<int, Avis>
     */
    public function getAvis(): Collection
    {
        return $this->avis;
    }

    /**
     * @return Collection<int, Contact>
     */
    public function getContact(): Collection
    {
        return $this->contact;
    }

    /**
     * @return Collection<int, Horaires>
     */
    public function getHoraires(): Collection
    {
        return $this->horaires;
    }

    public function addHoraires(Horaires $horaires): self
    {
        if (!$this->horaires->contains($horaires)) {
            $this->horaires[] = $horaires;
            $horaires->setUser($this);
        }

        return $this;
    }

    public function removeHoraires(Horaires $horaires): self
    {
        if ($this->horaires->removeElement($horaires)) {
            if ($horaires->getUser() === $this) {
                $horaires->setUser(null);
            }
        }

        return $this;
    }
}
