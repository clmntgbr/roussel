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
     * @var ?string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $title;

    /**
     * @var ?string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $type;

    /**
     * @var ?string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $content;

    /**
     * @var ?string
     *
     * @ORM\Column(type="float", nullable=true)
     */
    private $timeToRead;

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

    /**
     * @var Media|null
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Media", cascade={"persist", "remove"}, fetch="EAGER")
     * @ORM\JoinColumn(name="preview_id", referencedColumnName="id", onDelete="CASCADE", nullable=true)
     */
    private $preview;

    public function __construct()
    {
        $this->setTimeToRead();
    }

    public function setTimeToRead(): self
    {
        $word = str_word_count(strip_tags($this->content));
        $this->timeToRead = ceil($word/200);

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getTimeToRead(): ?float
    {
        return $this->timeToRead;
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

    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @return UploadedFile|null
     */
    public function getFile(): ?UploadedFile
    {
        return $this->file;
    }

    public function CreatedAtForExport()
    {
        return $this->createdAt->format('d/m/Y');
    }

    public function UpdatedAtForExport()
    {
        if($this->updatedAt === null) {
            return null;
        }
        return $this->updatedAt->format('d/m/Y');
    }

    public function CreatedByForExport()
    {
        return $this->createdBy->getEmail();
    }

    public function TitleForExport()
    {
        return strip_tags($this->title);
    }

    public function ContentForExport()
    {
        return strip_tags($this->content);
    }

    public function setCreatedBy(?User $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }
}
