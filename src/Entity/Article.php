<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @var UploadedFile|null
     */
    public $file;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $title;
    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $type;
    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $content;
    /**
     * @var string
     *
     * @ORM\Column(type="float")
     */
    private $timeToRead = 0;
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
     * @var Media|null
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Media", cascade={"persist", "remove"}, fetch="EAGER")
     * @ORM\JoinColumn(name="preview_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $preview;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getTimeToRead(): ?float
    {
        return $this->timeToRead;
    }

    public function setTimeToRead(float $timeToRead): self
    {
        $this->timeToRead = $timeToRead;

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

    public function getPreview(): ?Media
    {
        return $this->preview;
    }

    public function setPreview(?Media $preview): self
    {
        $this->preview = $preview;

        return $this;
    }

    /**
     * @return UploadedFile|null
     */
    public function getFile(): ?UploadedFile
    {
        return $this->file;
    }
}
