<?php

namespace App\GraphQL\Resolver;

use App\Entity\Gift;
use App\Entity\Media\Media;
use App\Service\MediaService;
use Doctrine\ORM\EntityManagerInterface;
use Overblog\GraphQLBundle\Definition\Resolver\QueryInterface;

class
MediaResolver extends AbstractResolver implements QueryInterface
{
    public function __construct(
        EntityManagerInterface $em,
        private readonly MediaService $mediaService
    ){
        parent::__construct(Media::class, $em);
    }

    public function resolveUrl(Media $media): string
    {
        return $this->mediaService->getUrl($media);
    }
}
