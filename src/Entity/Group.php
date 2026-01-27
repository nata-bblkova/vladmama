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
use App\Model\TimestampableInterface;
use App\Model\TimestampableTrait;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Group
{
    private int $id;
    private string $name;
    private string $description;
    private Institution $institution;

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

    public function setInstitution(Institution $institution): static
    {
        $this->institution = $institution;

        return $this;
    }

    public function getInstitution(): Institution
    {
        return $this->institution;
    }
}
