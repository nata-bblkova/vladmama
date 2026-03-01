<?php

namespace App\GraphQL\Resolver;

use App\Entity\News;
use Doctrine\ORM\EntityManagerInterface;
use Overblog\GraphQLBundle\Definition\Resolver\QueryInterface;

class NewsResolver extends AbstractResolver implements QueryInterface
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct(News::class, $em);
    }
}
