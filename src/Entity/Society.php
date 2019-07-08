<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SocietyRepository")
 */
class Society
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var ?string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $name;

    /**
     * @var ?string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $investmentFund;

    /**
     * @var ?string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $parentCompany;

    /**
     * @var ?string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $holding;

    /**
     * @var ?string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $sector;

    /**
     * @var ?string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $age;

    /**
     * @var ?string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $activity;

    /**
     * @var ?string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $turnover;

    /**
     * @var ?string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $grossOperatingSurplus;

    /**
     * @var ?string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $profitBeforeInterestAndTaxes;

    /**
     * @var ?string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $treasury;

    /**
     * @var ?string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $financialDebt;

    /**
     * @var ?string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $siren;

    /**
     * @var ?string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $phoneNumber;

    /**
     * @var ?string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $contactEmail;

    /**
     * @var ?string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $website;

    /**
     * @var \DateTimeImmutable
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateCreation;

    /**
     * @var \DateTimeImmutable
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateTurnover;

    /**
     * @var \DateTimeImmutable
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTimeImmutable
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var string
     *
     * @Gedmo\Blameable(on="create")
     * @ORM\Column(type="string")
     */
    private $createdBy;

    /**
     * @var Address|null
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Address", cascade={"persist", "remove"}, fetch="EAGER")
     * @ORM\JoinColumn(name="address_id", referencedColumnName="id", onDelete="CASCADE", nullable=true)
     */
    private $address;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Person", cascade={"persist", "remove"})
     * @ORM\JoinTable(name="society_leader")
     */
    private $leaders;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Note", cascade={"persist", "remove"})
     * @ORM\JoinTable(name="society_note")
     */
    private $notes;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Operation", cascade={"persist", "remove"})
     * @ORM\JoinTable(name="society_operation")
     */
    private $operations;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Implantation", cascade={"persist", "remove"})
     * @ORM\JoinTable(name="society_implantation")
     */
    private $implantations;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Specialty", cascade={"persist", "remove"})
     * @ORM\JoinTable(name="society_specialty")
     */
    private $specialties;

    public function __construct()
    {
        $this->leaders = new ArrayCollection();
        $this->notes = new ArrayCollection();
        $this->operations = new ArrayCollection();
        $this->implantations = new ArrayCollection();
        $this->specialties = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getInvestmentFund(): ?string
    {
        return $this->investmentFund;
    }

    public function setInvestmentFund(?string $investmentFund): self
    {
        $this->investmentFund = $investmentFund;

        return $this;
    }

    public function getParentCompany(): ?string
    {
        return $this->parentCompany;
    }

    public function setParentCompany(?string $parentCompany): self
    {
        $this->parentCompany = $parentCompany;

        return $this;
    }

    public function getHolding(): ?string
    {
        return $this->holding;
    }

    public function setHolding(?string $holding): self
    {
        $this->holding = $holding;

        return $this;
    }

    public function getSector(): ?string
    {
        return $this->sector;
    }

    public function setSector(?string $sector): self
    {
        $this->sector = $sector;

        return $this;
    }

    public function getAge(): ?string
    {
        return $this->age;
    }

    public function setAge(?string $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getActivity(): ?string
    {
        return $this->activity;
    }

    public function setActivity(?string $activity): self
    {
        $this->activity = $activity;

        return $this;
    }

    public function getTurnover(): ?string
    {
        return $this->turnover;
    }

    public function setTurnover(?string $turnover): self
    {
        $this->turnover = $turnover;

        return $this;
    }

    public function getGrossOperatingSurplus(): ?string
    {
        return $this->grossOperatingSurplus;
    }

    public function setGrossOperatingSurplus(?string $grossOperatingSurplus): self
    {
        $this->grossOperatingSurplus = $grossOperatingSurplus;

        return $this;
    }

    public function getProfitBeforeInterestAndTaxes(): ?string
    {
        return $this->profitBeforeInterestAndTaxes;
    }

    public function setProfitBeforeInterestAndTaxes(?string $profitBeforeInterestAndTaxes): self
    {
        $this->profitBeforeInterestAndTaxes = $profitBeforeInterestAndTaxes;

        return $this;
    }

    public function getTreasury(): ?string
    {
        return $this->treasury;
    }

    public function setTreasury(?string $treasury): self
    {
        $this->treasury = $treasury;

        return $this;
    }

    public function getFinancialDebt(): ?string
    {
        return $this->financialDebt;
    }

    public function setFinancialDebt(?string $financialDebt): self
    {
        $this->financialDebt = $financialDebt;

        return $this;
    }

    public function getSiren(): ?string
    {
        return $this->siren;
    }

    public function setSiren(?string $siren): self
    {
        $this->siren = $siren;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getContactEmail(): ?string
    {
        return $this->contactEmail;
    }

    public function setContactEmail(?string $contactEmail): self
    {
        $this->contactEmail = $contactEmail;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): self
    {
        $this->website = $website;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(?\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getDateTurnover(): ?\DateTimeInterface
    {
        return $this->dateTurnover;
    }

    public function setDateTurnover(?\DateTimeInterface $dateTurnover): self
    {
        $this->dateTurnover = $dateTurnover;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(?Address $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Collection|Person[]
     */
    public function getLeaders(): Collection
    {
        return $this->leaders;
    }

    public function addLeader(Person $leader): self
    {
        if (!$this->leaders->contains($leader)) {
            $this->leaders[] = $leader;
        }

        return $this;
    }

    public function removeLeader(Person $leader): self
    {
        if ($this->leaders->contains($leader)) {
            $this->leaders->removeElement($leader);
        }

        return $this;
    }

    /**
     * @return Collection|Note[]
     */
    public function getNotes(): Collection
    {
        return $this->notes;
    }

    public function addNote(Note $note): self
    {
        if (!$this->notes->contains($note)) {
            $this->notes[] = $note;
        }

        return $this;
    }

    public function removeNote(Note $note): self
    {
        if ($this->notes->contains($note)) {
            $this->notes->removeElement($note);
        }

        return $this;
    }

    /**
     * @return Collection|Operation[]
     */
    public function getOperations(): Collection
    {
        return $this->operations;
    }

    public function addOperation(Operation $operation): self
    {
        if (!$this->operations->contains($operation)) {
            $this->operations[] = $operation;
        }

        return $this;
    }

    public function removeOperation(Operation $operation): self
    {
        if ($this->operations->contains($operation)) {
            $this->operations->removeElement($operation);
        }

        return $this;
    }

    /**
     * @return Collection|Implantation[]
     */
    public function getImplantations(): Collection
    {
        return $this->implantations;
    }

    public function addImplantation(Implantation $implantation): self
    {
        if (!$this->implantations->contains($implantation)) {
            $this->implantations[] = $implantation;
        }

        return $this;
    }

    public function removeImplantation(Implantation $implantation): self
    {
        if ($this->implantations->contains($implantation)) {
            $this->implantations->removeElement($implantation);
        }

        return $this;
    }

    /**
     * @return Collection|Specialty[]
     */
    public function getSpecialties(): Collection
    {
        return $this->specialties;
    }

    public function addSpecialty(Specialty $specialty): self
    {
        if (!$this->specialties->contains($specialty)) {
            $this->specialties[] = $specialty;
        }

        return $this;
    }

    public function removeSpecialty(Specialty $specialty): self
    {
        if ($this->specialties->contains($specialty)) {
            $this->specialties->removeElement($specialty);
        }

        return $this;
    }

    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    public function CreatedAtForExport()
    {
        return $this->createdAt->format('d/m/Y');
    }
}
