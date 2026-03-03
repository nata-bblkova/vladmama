<?php

namespace App\GraphQL\Resolver;

use App\Entity\Promotion;
use Doctrine\ORM\EntityManagerInterface;
use Overblog\GraphQLBundle\Definition\Resolver\QueryInterface;

class PromotionResolver extends AbstractResolver implements QueryInterface
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct(Promotion::class, $em);
    }
}
