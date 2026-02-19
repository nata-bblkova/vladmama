<?php

namespace App\Entity;

use App\Entity\Media\Media;
use App\Enum\GiftStatusEnum;
use App\Model\ResourceInterface;
use App\Model\ResourceTrait;
use App\Model\TimestampableInterface;
use App\Model\TimestampableTrait;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Gift implements ResourceInterface, TimestampableInterface
{
    use ResourceTrait;
    use TimestampableTrait;

    private string $description;
    private GiftStatusEnum $giftStatusEnum = GiftStatusEnum::CREATED;
    private Promotion $promotion;
    private Child $child;
    private ?User $user = null;

    public function __toString(): string
    {
        return $this->description;
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

    public function setGiftStatusEnum(GiftStatusEnum $giftStatusEnum): static
    {
        $this->giftStatusEnum = $giftStatusEnum;

        return $this;
    }

    public function getGiftStatusEnum(): GiftStatusEnum
    {
        return $this->giftStatusEnum;
    }

    public function setPromotion(Promotion $promotion): static
    {
        $this->promotion = $promotion;

        return $this;
    }

    public function getPromotion(): Promotion
    {
        return $this->promotion;
    }

    public function setChild(Child $child): static
    {
        $this->child = $child;

        return $this;
    }

    public function getChild(): Child
    {
        return $this->child;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }
}
