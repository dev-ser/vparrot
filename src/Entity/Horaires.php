<?php

   namespace App\Entity;

   use App\Repository\HorairesRepository;
   use Doctrine\DBAL\Types\Types;
   use Doctrine\ORM\Mapping as ORM;
   
   use Doctrine\Common\Collections\ArrayCollection;
   use Doctrine\Common\Collections\Collection;
   
   #[ORM\Entity(repositoryClass: HorairesRepository::class)]
   class Horaires
   {


    #[ORM\ManyToOne(targetEntity: "App\Entity\User", inversedBy: "horaires")]
    #[ORM\JoinColumn(name: "user_id", referencedColumnName: "id")]
    private $user;

       #[ORM\Id]
       #[ORM\GeneratedValue]
       #[ORM\Column]
       private ?int $id = null;


       #[ORM\Column(length: 50, nullable: true)]
       private ?string $jour = null;
   
       #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
       private ?\DateTimeInterface $debutMatin = null;
   
       #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
       private ?\DateTimeInterface $finMatin = null;
   
       #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
       private ?\DateTimeInterface $debutApresMidi = null;
   
       #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
       private ?\DateTimeInterface $finApresMidi = null;

       public function getId(): ?int
       {
           return $this->id;
       }
   
       public function getJour(): ?string
       {
           return $this->jour;
       }
   
       public function setJour(?string $jour): static
       {
           $this->jour = $jour;
   
           return $this;
       }
   
       public function getDebutMatin(): ?\DateTimeInterface
       {
           return $this->debutMatin;
       }
   
       public function setDebutMatin(?\DateTimeInterface $debutMatin): static
       {
           $this->debutMatin = $debutMatin;
   
           return $this;
       }
   
       public function getFinMatin(): ?\DateTimeInterface
       {
           return $this->finMatin;
       }
   
       public function setFinMatin(?\DateTimeInterface $finMatin): static
       {
           $this->finMatin = $finMatin;
   
           return $this;
       }
   
       public function getDebutApresMidi(): ?\DateTimeInterface
       {
           return $this->debutApresMidi;
       }
   
       public function setDebutApresMidi(?\DateTimeInterface $debutApresMidi): static
       {
           $this->debutApresMidi = $debutApresMidi;
   
           return $this;
       }
   
       public function getFinApresMidi(): ?\DateTimeInterface
       {
           return $this->finApresMidi;
       }
   
       public function setFinApresMidi(?\DateTimeInterface $finApresMidi): static
       {
           $this->finApresMidi = $finApresMidi;
   
           return $this;
       }
   
    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User|null $user
     * @return $this
     */
    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}