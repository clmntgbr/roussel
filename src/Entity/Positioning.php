<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PositioningRepository")
 */
class Positioning
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
    private $operationType;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $approach;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOperationType(): ?string
    {
        return $this->operationType;
    }

    public function setOperationType(string $operationType): self
    {
        $this->operationType = $operationType;

        return $this;
    }

    public function getApproach(): ?string
    {
        return $this->approach;
    }

    public function setApproach(string $approach): self
    {
        $this->approach = $approach;

        return $this;
    }
}
