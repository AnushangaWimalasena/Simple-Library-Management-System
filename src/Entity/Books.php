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
     * @ORM\Column(type="string", length=3)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $status;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Batch", inversedBy="books", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $batch;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Barrow", mappedBy="book", cascade={"persist", "remove"})
     */
    private $barrow;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    public function _toString()
    {
        return strval($this->id);
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

    public function getBatch(): ?Batch
    {
        return $this->batch;
    }

    public function setBatch(Batch $batch): self
    {
        $this->batch = $batch;

        return $this;
    }

    public function getBarrow(): ?Barrow
    {
        return $this->barrow;
    }

    public function setBarrow(Barrow $barrow): self
    {
        $this->barrow = $barrow;

        // set the owning side of the relation if necessary
        if ($barrow->getBook() !== $this) {
            $barrow->setBook($this);
        }

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

}
