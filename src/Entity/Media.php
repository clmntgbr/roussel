<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MediaRepository")
 */
class Media
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
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $type;

    /**
     * @var ?string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $path;

    public function __construct(string $name, string $type, $path)
    {
        $this->name = $name;
        $this->type = $type;
        $this->path = $path;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getFile()
    {
        if($this->path === null) {
            return $this->name;
        }
        return sprintf('%s%s', $this->path, $this->name);
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(?string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function updateMedia(string $name, string $type, $path)
    {
        $this->name = $name;
        $this->type = $type;
        $this->path = $path;

        return $this;
    }
}
