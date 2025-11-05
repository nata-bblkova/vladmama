<?php

namespace App\Model;

use DateTime;

interface TimestampableInterface
{
    public function setCreatedAt(DateTime $createdAt): static;

    public function getCreatedAt(): DateTime;

    public function setUpdatedAt(DateTime $updatedAt): static;

    public function getUpdatedAt(): DateTime;
}
