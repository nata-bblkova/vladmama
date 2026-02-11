<?php

namespace App\Entity\Media;

use App\Model\ResourceInterface;
use App\Model\ResourceTrait;
use ArrayAccess;
use Doctrine\Common\Collections\ArrayCollection;
use Sonata\MediaBundle\Entity\BaseGallery;
use Sonata\MediaBundle\Model\GalleryItemInterface;

/**
 * Class Gallery.
 */
class Gallery extends BaseGallery implements ResourceInterface, ArrayAccess
{
    use ResourceTrait;

    /**
     * @var string
     */
    protected string $uniqueKey;

    /**
     * Gallery constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setUniqueKey(self::generateUniqueKey());
    }

    /**
     * @param string $prefix
     *
     * @return string
     */
    public static function generateUniqueKey(string $prefix = ''): string
    {
        return uniqid($prefix, true);
    }

    /**
     * @return ArrayCollection<Media>
     *
     * @psalm-suppress InvalidArgument
     */
    public function getMedias(): ArrayCollection
    {
        $res = new ArrayCollection();

        foreach ($this->getGalleryItems() as $galleryHasMedia) {
            $res->add($galleryHasMedia->getMedia());
        }

        return $res;
    }

    /**
     * @param GalleryItemInterface $galleryHasMedia
     *
     * @return $this
     */
    public function removeGalleryHasMedia(GalleryItemInterface $galleryHasMedia): static
    {
        if ($this->galleryItems->contains($galleryHasMedia)) {
            $galleryHasMedia->setGallery(null);

            $this->galleryItems->removeElement($galleryHasMedia);
        }

        return $this;
    }

    /**
     * @param mixed $offset
     *
     * @return mixed
     *
     * @psalm-suppress MissingParamType
     */
    public function offsetGet(mixed $offset): mixed
    {
        return null;
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     *
     * @psalm-suppress MissingParamType
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
    }

    /**
     * @param mixed $offset
     *
     * @return bool
     *
     * @psalm-suppress MissingParamType
     */
    public function offsetExists(mixed $offset): bool
    {
        return false;
    }

    /**
     * @param mixed $offset
     *
     * @psalm-suppress MissingParamType
     */
    public function offsetUnset(mixed $offset): void
    {
    }

    /**
     * @param string $uniqueKey
     *
     * @return $this
     */
    public function setUniqueKey(string $uniqueKey): static
    {
        $this->uniqueKey = $uniqueKey;

        return $this;
    }

    /**
     * @return string
     */
    public function getUniqueKey(): string
    {
        return $this->uniqueKey;
    }
}
