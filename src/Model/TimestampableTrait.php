<?php

namespace App\Model;

use DateTime;

trait TimestampableTrait
{
    protected DateTime $createdAt;

    protected DateTime $updatedAt;

    public function setCreatedAt(DateTime $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setUpdatedAt(DateTime $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
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
