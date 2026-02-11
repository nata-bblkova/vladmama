<?php

namespace App\Entity\Media;

use Sonata\MediaBundle\Entity\BaseMedia;

class Media extends BaseMedia
{
    protected ?int $id = null;
    public function getId(): ?int
    {
        return $this->id;
    }
}
