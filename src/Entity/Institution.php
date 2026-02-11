<?php

namespace App\Entity;

use App\Entity\Media\Media;
use App\Model\CoordinatesInterface;
use App\Model\CoordinatesTrait;
use App\Model\ResourceInterface;
use App\Model\ResourceTrait;
use App\Model\TimestampableInterface;
use App\Model\TimestampableTrait;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Institution implements ResourceInterface, TimestampableInterface, CoordinatesInterface
{
    use ResourceTrait;
    use TimestampableTrait;
    use CoordinatesTrait;

    private string $name;
    private string $description;
    private string $address;
    private ?Media $image = null;

    /** @var Collection<Group> */
    private Collection $groups;

    public function __construct()
    {
        $this->groups  = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setImage(?Media $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getImage(): ?Media
    {
        return $this->image;
    }

    public function setGroups(Collection $groups): static
    {
        $this->groups = $groups;

        return $this;
    }

    public function addGroup(Group $group): static
    {
        $this->groups->add($group);

        return $this;
    }

    public function removeGroup(Group $group): static
    {
        $this->groups->removeElement($group);

        return $this;
    }

    public function getGroups(): Collection
    {
        return $this->groups;
    }
}
