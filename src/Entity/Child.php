<?php

/**
 * This file was developed by company Taptima
 *
 * @author    it@taptima.ru
 * @author    m@taptima.ru
 * @copyright 2014-2025 Taptima
 * @link      https://taptima.ru
 */

namespace App\Entity;

use App\Entity\Security\User;
use App\Enum\DeliveryTypeEnum;
use App\Enum\OrderStatusEnum;
use App\Enum\PaymentTypeEnum;
use App\Model\ResourceInterface;
use App\Model\ResourceTrait;
use App\Model\TimestampableInterface;
use App\Model\TimestampableTrait;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Child implements ResourceInterface, TimestampableInterface
{
    use ResourceTrait;
    use TimestampableTrait;

    private string $name;
    private string $description;
    private ?string $desire = null;
    private ?Institution $institution = null;
    private ?Group $group = null;
    private DateTime $birthday;

    public function __toString(): string
    {
        return $this->name;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
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

    public function setDesire(?string $desire): static
    {
        $this->desire = $desire;

        return $this;
    }

    public function getDesire(): ?string
    {
        return $this->desire;
    }

    public function setInstitution(?Institution $institution): static
    {
        $this->institution = $institution;

        return $this;
    }

    public function getInstitution(): ?Institution
    {
        return $this->institution;
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
}
