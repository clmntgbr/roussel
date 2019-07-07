<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $geography;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $ve;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $investmentTicket;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $investmentSector;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGeography(): ?string
    {
        return $this->geography;
    }

    public function setGeography(string $geography): self
    {
        $this->geography = $geography;

        return $this;
    }

    public function getVe(): ?string
    {
        return $this->ve;
    }

    public function setVe(string $ve): self
    {
        $this->ve = $ve;

        return $this;
    }

    public function getInvestmentTicket(): ?string
    {
        return $this->investmentTicket;
    }

    public function setInvestmentTicket(string $investmentTicket): self
    {
        $this->investmentTicket = $investmentTicket;

        return $this;
    }

    public function getInvestmentSector(): ?string
    {
        return $this->investmentSector;
    }

    public function setInvestmentSector(string $investmentSector): self
    {
        $this->investmentSector = $investmentSector;

        return $this;
    }
}
