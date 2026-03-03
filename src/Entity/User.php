<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sonata\UserBundle\Entity\BaseUser3;
use Symfony\Component\Validator\Constraints as Assert;

class User extends BaseUser3
{
    private ?string $firstname;
    private ?string $lastname;
    private ?string $middlename;
    #[Assert\Regex(pattern: '/^\\+7\\d{10}$/')]
    private ?string $phone;

    /** @var Collection<Gift> */
    private Collection $gifts;

    public function __construct()
    {
        $this->gifts  = new ArrayCollection();
    }

    public function setFirstname(?string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setLastname(?string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setMiddlename(?string $middlename): static
    {
        $this->middlename = $middlename;

        return $this;
    }

    public function getMiddlename(): ?string
    {
        return $this->middlename;
    }

    public function setPhone(?string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }


    public function setGifts(Collection $gifts): static
    {
        $this->gifts = $gifts;

        return $this;
    }

    public function addGift(Gift $gift): static
    {
        $this->gifts->add($gift);

        return $this;
    }

    public function removeGift(Gift $gift): static
    {
        $this->gifts->removeElement($gift);

        return $this;
    }

    public function getGifts(): Collection
    {
        return $this->gifts;
    }
}
