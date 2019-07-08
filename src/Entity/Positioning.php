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
     * @var ?string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $operationType;

    /**
     * @var ?string
     *
     * @ORM\Column(type="string", nullable=true)
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

    public function setOperationType(?string $operationType): self
    {
        $this->operationType = $operationType;

        return $this;
    }

    public function getApproach(): ?string
    {
        return $this->approach;
    }

    public function setApproach(?string $approach): self
    {
        $this->approach = $approach;

        return $this;
    }

    public function __toString()
    {
        $html = "<ul>";
        $html .= $this->operationType ? "<li>" . $this->operationType . "</li>" : "";
        $html .= $this->approach ? "<li>" . $this->approach . "</li>" : "";
        $html .= "</ul>";
        return $html;
    }
}
