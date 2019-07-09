<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TargetRepository")
 */
class Target
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
    private $geography;

    /**
     * @var ?string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $ve;

    /**
     * @var ?string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $investmentTicket;

    /**
     * @var ?string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $investmentSector;

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
     * @var User
     *
     * @Gedmo\Blameable(on="create")
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="created_by", referencedColumnName="id")
     */
    private $createdBy;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGeography(): ?string
    {
        return $this->geography;
    }

    public function setGeography(?string $geography): self
    {
        $this->geography = $geography;

        return $this;
    }

    public function getVe(): ?string
    {
        return $this->ve;
    }

    public function setVe(?string $ve): self
    {
        $this->ve = $ve;

        return $this;
    }

    public function getInvestmentTicket(): ?string
    {
        return $this->investmentTicket;
    }

    public function setInvestmentTicket(?string $investmentTicket): self
    {
        $this->investmentTicket = $investmentTicket;

        return $this;
    }

    public function getInvestmentSector(): ?string
    {
        return $this->investmentSector;
    }

    public function setInvestmentSector(?string $investmentSector): self
    {
        $this->investmentSector = $investmentSector;

        return $this;
    }

    public function __toString()
    {
        return sprintf(
            '<ul><li>%s</li><li>%s</li><li>%s</li><li>%s</li></ul>',
            $this->geography,
            $this->ve,
            $this->investmentTicket,
            $this->investmentSector
        );
    }

    public function __toStringForExport()
    {
        return sprintf(
            '[%s, %s, %s, %s]',
            $this->geography,
            $this->ve,
            $this->investmentTicket,
            $this->investmentSector
        );
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

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }
}
