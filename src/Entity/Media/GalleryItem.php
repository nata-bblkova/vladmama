<?php

namespace App\Entity\Media;

use App\Model\ResourceInterface;
use App\Model\ResourceTrait;
use Sonata\MediaBundle\Model\GalleryItem as BaseGalleryItem;

class GalleryItem extends BaseGalleryItem implements ResourceInterface
{
    use ResourceTrait;
}
