<?php

namespace App\Entity;

use App\Repository\CandidatsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CandidatsRepository::class)]
class Candidats
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

  

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column(length: 255)]
    private ?string $country = null;

    #[ORM\Column(length: 255)]
    private ?string $nationalite = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $birthdate = null;

    #[ORM\Column(length: 255)]
    private ?string $birthplace = null;

    #[ORM\Column(length: 255)]
    private ?string $currentLocation = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?User $user = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Media $photo = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Media $passeport = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Media $cv = null;

    #[ORM\OneToMany(targetEntity: Candidatures::class, mappedBy: 'candidat')]
    private Collection $candidatures;

    #[ORM\ManyToOne(inversedBy: 'candidats')]
    private ?Gender $gender = null;

    #[ORM\ManyToOne(inversedBy: 'candidats')]
    private ?Experience $experience = null;

    #[ORM\ManyToOne(inversedBy: 'candidats')]
    private ?Categorie $interestJob = null;

    #[ORM\Column(nullable: true)]
    private ?int $pourcentage = null;

  

    // custom function
  public function checkPercentCompleted(): int
  {
      $totalFields = 15;
      $percentPart = 100/15; //6.66
      $actualPercent = 0;


      $genderValue = $this->getGender();
      if(!empty($genderValue)) {
        $actualPercent += $percentPart;
      }

      $firstnameValue = $this->getFirstName();
      if (!empty($firstnameValue)) {
          $actualPercent += $percentPart;
      }
      $lastnameValue = $this->getLastName();
      if (!empty($lastnameValue)) {
          $actualPercent += $percentPart;
      }
      $cityValue = $this->getCurrentLocation();
      if (!empty($cityValue)) {
          $actualPercent += $percentPart;
      }
      $adressValue = $this->getAddress();
      if (!empty($adressValue)) {
          $actualPercent += $percentPart;
      }
      $countryValue = $this->getCountry();
      if (!empty($countryValue)) {
          $actualPercent += $percentPart;
      }
      $nationalityValue =$this->getNationalite();
      if (!empty($nationalityValue)) {
          $actualPercent += $percentPart;
      }
      $passportValue = $this->getPasseport();
      if (!empty($passportValue)) {
          $actualPercent += $percentPart;
      }
      $curriculumValue = $this->getCv();
      if (!empty($curriculumValue)) {
          $actualPercent += $percentPart;
      }
      $pictureValue = $this->getPhoto();
      if (!empty($pictureValue)) {
          $actualPercent += $percentPart;
      }
      $dateOfBirthValue = $this->getBirthDate();
      if (!empty($dateOfBirthValue)) {
          $actualPercent += $percentPart;
      }
      $placeOfBirthValue = $this->getBirthPlace();
      if (!empty($placeOfBirthValue)) {
          $actualPercent += $percentPart;
      }
      $sectorValue = $this->getInterestJob();
      if (!empty($sectorValue)) {
          $actualPercent += $percentPart;
      }
      $experienceValue = $this->getExperience();
      if (!empty($experienceValue)) {
          $actualPercent += $percentPart;
      }
      $descriptionValue = $this->getDescription();
      if (!empty($descriptionValue)) {
          $actualPercent += $percentPart;
      }
      return round($actualPercent);
  }

    public function __construct()
    {
        $this->candidatures = new ArrayCollection();
    }

   

    public function getId(): ?int
    {
        return $this->id;
    }

   

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getNationalite(): ?string
    {
        return $this->nationalite;
    }

    public function setNationalite(string $nationalite): static
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(\DateTimeInterface $birthdate): static
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getBirthplace(): ?string
    {
        return $this->birthplace;
    }

    public function setBirthplace(string $birthplace): static
    {
        $this->birthplace = $birthplace;

        return $this;
    }

    public function getCurrentLocation(): ?string
    {
        return $this->currentLocation;
    }

    public function setCurrentLocation(string $currentLocation): static
    {
        $this->currentLocation = $currentLocation;

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



    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

   

    public function getPhoto(): ?Media
    {
        return $this->photo;
    }

    public function setPhoto(?Media $photo): static
    {
        $this->photo = $photo;

        return $this;
    }

    public function getPasseport(): ?Media
    {
        return $this->passeport;
    }

    public function setPasseport(?Media $passeport): static
    {
        $this->passeport = $passeport;

        return $this;
    }

    public function getCv(): ?Media
    {
        return $this->cv;
    }

    public function setCv(?Media $cv): static
    {
        $this->cv = $cv;

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
            $candidature->setCandidat($this);
        }

        return $this;
    }

    public function removeCandidature(Candidatures $candidature): static
    {
        if ($this->candidatures->removeElement($candidature)) {
            // set the owning side to null (unless already changed)
            if ($candidature->getCandidat() === $this) {
                $candidature->setCandidat(null);
            }
        }

        return $this;
    }

    public function getGender(): ?Gender
    {
        return $this->gender;
    }

    public function setGender(?Gender $gender): static
    {
        $this->gender = $gender;

        return $this;
    }

    public function getExperience(): ?Experience
    {
        return $this->experience;
    }

    public function setExperience(?Experience $experience): static
    {
        $this->experience = $experience;

        return $this;
    }

    public function getInterestJob(): ?Categorie
    {
        return $this->interestJob;
    }

    public function setInterestJob(?Categorie $interestJob): static
    {
        $this->interestJob = $interestJob;

        return $this;
    }

    public function getPourcentage(): ?int
    {
        return $this->pourcentage;
    }

    public function setPourcentage(?int $pourcentage): static
    {
        $this->pourcentage = $pourcentage;

        return $this;
    }

  

  
}
