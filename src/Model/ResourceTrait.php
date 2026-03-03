<?php

namespace App\Model;

trait ResourceTrait
{
    protected int $id;

    public function getId()
    {
        return $this->id;
    }
}
