<?php

namespace App\Model;

use DateTime;

interface CoordinatesInterface
{
    public function setLongitude(?float $longitude): static;

    public function getLongitude(): ?float;

    public function setLatitude(?float $latitude): static;

    public function getLatitude(): ?float;
}
