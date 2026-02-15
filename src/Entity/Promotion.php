<?php

namespace App\Entity;

use App\Entity\Media\Media;
use App\Model\ResourceInterface;
use App\Model\ResourceTrait;
use App\Model\TimestampableInterface;
use App\Model\TimestampableTrait;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Promotion implements ResourceInterface, TimestampableInterface
{
    use ResourceTrait;
    use TimestampableTrait;

    private string $name;
    private string $description;
    private string $rules;
    private DateTime $datePublication;
    private DateTime $startDate;
    private DateTime $endDate;
    private Category $category;
    private ?Media $image = null;

    /** @var Collection<Institution> */
    private Collection $institutions;

    public function __construct()
    {
        $this->institutions  = new ArrayCollection();
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

    public function setRules(string $rules): static
    {
        $this->rules = $rules;

        return $this;
    }

    public function getRules(): string
    {
        return $this->rules;
    }

    public function setDatePublication(DateTime $datePublication): static
    {
        $this->datePublication = $datePublication;

        return $this;
    }

    public function getDatePublication(): DateTime
    {
        return $this->datePublication;
    }

    public function setStartDate(DateTime $startDate): static
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getStartDate(): DateTime
    {
        return $this->startDate;
    }

    public function setEndDate(DateTime $endDate): static
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getEndDate(): DateTime
    {
        return $this->endDate;
    }

    public function setCategory(Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getCategory(): Category
    {
        return $this->category;
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

    public function setInstitutions(Collection $institutions): static
    {
        $this->institutions = $institutions;

        return $this;
    }

    public function addInstitution(Institution $institution): static
    {
        $this->institutions->add($institution);

        return $this;
    }

    public function removeInstitution(Institution $institution): static
    {
        $this->institutions->removeElement($institution);

        return $this;
    }

    public function getInstitutions(): Collection
    {
        return $this->institutions;
    }
}
