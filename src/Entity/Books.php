<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BooksRepository")
 */
class Books
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=7)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $status;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Batch", inversedBy="books")
     * @ORM\JoinColumn(nullable=false)
     */
    private $batch;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Barrow", mappedBy="book")
     */
    private $barrows;

    public function __construct()
    {
        $this->barrows = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getBatch(): ?Batch
    {
        return $this->batch;
    }

    public function setBatch(?Batch $batch): self
    {
        $this->batch = $batch;

        return $this;
    }

    /**
     * @return Collection|Barrow[]
     */
    public function getBarrows(): Collection
    {
        return $this->barrows;
    }

    public function addBarrow(Barrow $barrow): self
    {
        if (!$this->barrows->contains($barrow)) {
            $this->barrows[] = $barrow;
            $barrow->setBook($this);
        }

        return $this;
    }

    public function removeBarrow(Barrow $barrow): self
    {
        if ($this->barrows->contains($barrow)) {
            $this->barrows->removeElement($barrow);
            // set the owning side to null (unless already changed)
            if ($barrow->getBook() === $this) {
                $barrow->setBook(null);
            }
        }

        return $this;
    }
}
