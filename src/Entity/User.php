<?php

namespace App\Entity;

use Sonata\UserBundle\Entity\BaseUser3;
use Symfony\Component\Validator\Constraints as Assert;

class User extends BaseUser3
{
    private ?string $firstname;
    private ?string $lastname;
    private ?string $middlename;
    #[Assert\Regex(pattern: '/^\\+7\\d{10}$/')]
    private ?string $phone;

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
}