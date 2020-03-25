<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BatchRepository")
 */
class Batch
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Books", mappedBy="batch", cascade={"persist", "remove"})
     */
    private $books;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $catogary;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     */
    private $noOfBook;

    public function _toString()
    {
        return strval($this->id);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBooks(): ?Books
    {
        return $this->books;
    }

    public function setBooks(Books $books): self
    {
        $this->books = $books;

        // set the owning side of the relation if necessary
        if ($books->getBatch() !== $this) {
            $books->setBatch($this);
        }

        return $this;
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

    public function getCatogary(): ?string
    {
        return $this->catogary;
    }

    public function setCatogary(string $catogary): self
    {
        $this->catogary = $catogary;

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

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getNoOfBook(): ?int
    {
        return $this->noOfBook;
    }

    public function setNoOfBook(int $noOfBook): self
    {
        $this->noOfBook = $noOfBook;

        return $this;
    }
}
