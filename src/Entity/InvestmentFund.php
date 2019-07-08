<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InvestmentFundRepository")
 */
class InvestmentFund
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
     * @ORM\Column(type="datetime")
     */
    private $dateCreation;

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
     * @var Positioning|null
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Positioning", cascade={"persist", "remove"}, fetch="EAGER")
     * @ORM\JoinColumn(name="positioning_id", referencedColumnName="id", onDelete="CASCADE", nullable=true)
     */
    private $positioning;

    /**
     * @var Target|null
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Target", cascade={"persist", "remove"}, fetch="EAGER")
     * @ORM\JoinColumn(name="target_id", referencedColumnName="id", onDelete="CASCADE", nullable=true)
     */
    private $target;

    /**
     * @var FundsUnderManagement|null
     *
     * @ORM\OneToOne(targetEntity="App\Entity\FundsUnderManagement", cascade={"persist", "remove"}, fetch="EAGER")
     * @ORM\JoinColumn(name="funds_under_management_id", referencedColumnName="id", onDelete="CASCADE", nullable=true)
     */
    private $fundsUnderManagement;

    /**
     * @var Note[]
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Note", cascade={"persist", "remove"})
     * @ORM\JoinTable(name="investment_fund_note")
     */
    private $notes;

    /**
     * @var Person[]
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Person", cascade={"persist", "remove"})
     * @ORM\JoinTable(name="investment_fund_contact")
     */
    private $contacts;

    public function __construct()
    {
        $this->notes = new ArrayCollection();
        $this->contacts = new ArrayCollection();
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

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

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

    public function getPositioning(): ?Positioning
    {
        return $this->positioning;
    }

    public function setPositioning(?Positioning $positioning): self
    {
        $this->positioning = $positioning;

        return $this;
    }

    public function getTarget(): ?Target
    {
        return $this->target;
    }

    public function setTarget(?Target $target): self
    {
        $this->target = $target;

        return $this;
    }

    public function getFundsUnderManagement(): ?FundsUnderManagement
    {
        return $this->fundsUnderManagement;
    }

    public function setFundsUnderManagement(?FundsUnderManagement $fundsUnderManagement): self
    {
        $this->fundsUnderManagement = $fundsUnderManagement;

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
     * @return Collection|Person[]
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    public function addContact(Person $contact): self
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts[] = $contact;
        }

        return $this;
    }

    public function removeContact(Person $contact): self
    {
        if ($this->contacts->contains($contact)) {
            $this->contacts->removeElement($contact);
        }

        return $this;
    }

    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    public function ContactsExport()
    {
        $tmp = [];
        foreach ($this->contacts as $contact) {
            $tmp[] = sprintf('[%s, %s]', $contact->getName(), $contact->getContactEmail());
        }
        return implode(', ', $tmp);
    }

    public function CreatedAtForExport()
    {
        return $this->createdAt->format('d/m/Y');
    }

    public function TargetExport()
    {
        return trim($this->getTarget()->__toStringForExport());
    }

    public function PositioningExport()
    {
        return trim($this->getPositioning()->__toStringForExport());
    }
}
