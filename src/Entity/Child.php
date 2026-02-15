<?php

namespace App\Entity;

use App\Model\ResourceInterface;
use App\Model\ResourceTrait;
use App\Model\TimestampableInterface;
use App\Model\TimestampableTrait;
use DateTime;

class Child implements ResourceInterface, TimestampableInterface
{
    use ResourceTrait;
    use TimestampableTrait;

    private string $name;
    private ?string $desire = null;
    private ?Group $group = null;
    private ?DateTime $birthday = null;

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

    public function setDesire(?string $desire): static
    {
        $this->desire = $desire;

        return $this;
    }

    public function getDesire(): ?string
    {
        return $this->desire;
    }

    public function setGroup(?Group $group): static
    {
        $this->group = $group;

        return $this;
    }

    public function getGroup(): ?Group
    {
        return $this->group;
    }

    public function setBirthday(?DateTime $birthday): static
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getBirthday(): ?DateTime
    {
        return $this->birthday;
    }
}
