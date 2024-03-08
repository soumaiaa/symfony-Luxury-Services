<?php

namespace App\Entity;

use App\Repository\OffresRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OffresRepository::class)]
class Offres
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

   

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(length: 255)]
    private ?string $position = null;

    #[ORM\Column(length: 255)]
    private ?string $location = null;

    #[ORM\ManyToOne(inversedBy: 'offres')]
    private ?TypeContract $typecontract = null;

    #[ORM\Column]
    private ?int $salaire = null;

    #[ORM\ManyToOne(inversedBy: 'offres')]
    private ?Categorie $categorie = null;

    #[ORM\Column(length: 255)]
    private ?string $ref = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $statut = null;

    #[ORM\Column(length: 255)]
    private ?string $dateCloture = null;

    #[ORM\ManyToOne(inversedBy: 'offres')]
    private ?Clients $client = null;

    #[ORM\OneToMany(targetEntity: Candidatures::class, mappedBy: 'offre')]
    private Collection $candidatures;

    #[ORM\Column(length: 255)]
    private ?string $startingDate = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updeatedAT = null;

   

   

    public function __construct()
    {
        $this->candidatures = new ArrayCollection();
        $this->createdAt = new DateTimeImmutable();
        $this->updeatedAT = new DateTimeImmutable();
       
    }
    public function __toString()
    {
        return $this->client;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(string $position): static
    {
        $this->position = $position;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getTypecontract(): ?TypeContract
    {
        return $this->typecontract;
    }

    public function setTypecontract(?TypeContract $typecontract): static
    {
        $this->typecontract = $typecontract;

        return $this;
    }

    public function getSalaire(): ?int
    {
        return $this->salaire;
    }

    public function setSalaire(int $salaire): static
    {
        $this->salaire = $salaire;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getRef(): ?string
    {
        return $this->ref;
    }

    public function setRef(string $ref): static
    {
        $this->ref = $ref;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getDateCloture(): ?string
    {
        return $this->dateCloture;
    }

    public function setDateCloture(string $dateCloture): static
    {
        $this->dateCloture = $dateCloture;

        return $this;
    }

    public function getClient(): ?Clients
    {
        return $this->client;
    }

    public function setClient(?Clients $client): static
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return Collection<int, Candidatures>
     */
    public function getCandidatures(): Collection
    {
        return $this->candidatures;
    }

    public function addCandidature(Candidatures $candidature): static
    {
        if (!$this->candidatures->contains($candidature)) {
            $this->candidatures->add($candidature);
            $candidature->setOffre($this);
        }

        return $this;
    }

    public function removeCandidature(Candidatures $candidature): static
    {
        if ($this->candidatures->removeElement($candidature)) {
            // set the owning side to null (unless already changed)
            if ($candidature->getOffre() === $this) {
                $candidature->setOffre(null);
            }
        }

        return $this;
    }

    public function getStartingDate(): ?string
    {
        return $this->startingDate;
    }

    public function setStartingDate(string $startingDate): static
    {
        $this->startingDate = $startingDate;

        return $this;
    }

    public function getUpdeatedAT(): ?\DateTimeImmutable
    {
        return $this->updeatedAT;
    }

    public function setUpdeatedAT(\DateTimeImmutable $updeatedAT): static
    {
        $this->updeatedAT = $updeatedAT;

        return $this;
    }

 

}
