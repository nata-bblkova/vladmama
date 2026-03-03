<?php

namespace App\Entity;

use App\Model\CoordinatesInterface;
use App\Model\CoordinatesTrait;
use App\Model\ResourceInterface;
use App\Model\ResourceTrait;
use App\Model\TimestampableInterface;
use App\Model\TimestampableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Group implements ResourceInterface, TimestampableInterface
{
    use ResourceTrait;
    use TimestampableTrait;

    private string $name;
    private string $description;
    private Institution $institution;

    /** @var Collection<Child> */
    private Collection $children;

    public function __construct()
    {
        $this->children  = new ArrayCollection();
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

    public function setInstitution(Institution $institution): static
    {
        $this->institution = $institution;

        return $this;
    }

    public function getInstitution(): Institution
    {
        return $this->institution;
    }


    public function setChildren(Collection $children): static
    {
        $this->children = $children;

        return $this;
    }

    public function addChild(Child $child): static
    {
        $this->children->add($child);

        return $this;
    }

    public function removeChild(Child $child): static
    {
        $this->children->removeElement($child);

        return $this;
    }

    public function getChildren(): Collection
    {
        return $this->children;
    }
}
