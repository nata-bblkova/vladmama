<?php

namespace App\Entity\Media;

use App\Model\ResourceInterface;
use App\Model\ResourceTrait;
use Sonata\MediaBundle\Entity\BaseMedia;

class Media extends BaseMedia implements ResourceInterface
{
    protected ?int $id = null;
    public function getId(): ?int
    {
        return $this->id;
    }
}
