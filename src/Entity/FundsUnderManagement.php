<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FundsUnderManagementRepository")
 */
class FundsUnderManagement
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
    private $capitalStructure;

    /**
     * @var ?string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $managedCapital;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCapitalStructure(): ?string
    {
        return $this->capitalStructure;
    }

    public function setCapitalStructure(?string $capitalStructure): self
    {
        $this->capitalStructure = $capitalStructure;

        return $this;
    }

    public function getManagedCapital(): ?string
    {
        return $this->managedCapital;
    }

    public function setManagedCapital(?string $managedCapital): self
    {
        $this->managedCapital = $managedCapital;

        return $this;
    }
}
