<?php

namespace App\Model;

use DateTime;

trait AddressTrait
{
    private string $address;
    private ?float $longitude;
    private ?float $latitude;

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setLongitude(?float $longitude): static
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLatitude(?float $latitude): static
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function prePersist(): void
    {
        $this->createdAt = new DateTime();
        $this->updatedAt = new DateTime();
    }

    public function preUpdate(): void
    {
        $this->updatedAt = new DateTime();
    }

    /**
     * @return int
     */
    public function getCreatedAtTimestamp(): int
    {
        return $this->createdAt->getTimestamp();
    }

    /**
     * @return int
     */
    public function getUpdatedAtTimestamp(): int
    {
        return $this->updatedAt->getTimestamp();
    }
}
