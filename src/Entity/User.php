<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $role;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="integer")
     */
    private $tp;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Barrow", mappedBy="user")
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

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getLName(): ?string
    {
        return $this->lName;
    }

    public function setLName(string $lName): self
    {
        $this->lName = $lName;

        return $this;
    }

    public function getFName(): ?string
    {
        return $this->fName;
    }

    public function setFName(string $fName): self
    {
        $this->fName = $fName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTp(): ?int
    {
        return $this->tp;
    }

    public function setTp(int $tp): self
    {
        $this->tp = $tp;

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
            $barrow->setUser($this);
        }

        return $this;
    }

    public function removeBarrow(Barrow $barrow): self
    {
        if ($this->barrows->contains($barrow)) {
            $this->barrows->removeElement($barrow);
            // set the owning side to null (unless already changed)
            if ($barrow->getUser() === $this) {
                $barrow->setUser(null);
            }
        }

        return $this;
    }
}
