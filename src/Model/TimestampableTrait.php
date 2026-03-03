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

    public function prePersistTimestampable(): void
    {
        $this->createdAt = new DateTime();
        $this->updatedAt = new DateTime();
    }

    public function preUpdateTimestampable(): void
    {
        $this->updatedAt = new DateTime();
    }
}
