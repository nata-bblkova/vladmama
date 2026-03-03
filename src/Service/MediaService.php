<?php

namespace App\Service;

use App\Model\ResourceInterface;
use App\Model\ResourceTrait;
use Sonata\MediaBundle\Entity\BaseMedia;
use Sonata\MediaBundle\Model\MediaInterface;
use Sonata\MediaBundle\Provider\Pool;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class MediaService
{
    use ResourceTrait;

    public function __construct(
        private readonly Pool $mediaPool,
        private readonly UrlGeneratorInterface $urlGenerator,
    ) {
    }

    public function getUrl(MediaInterface $media): string
    {
        $provider = $this->mediaPool->getProvider($media->getProviderName());

        return $provider->generatePublicUrl($media, 'reference');
    }
}
