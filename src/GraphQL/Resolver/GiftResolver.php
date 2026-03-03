<?php

namespace App\GraphQL\Resolver;

use App\Entity\Gift;
use Doctrine\ORM\EntityManagerInterface;
use Overblog\GraphQLBundle\Definition\Resolver\QueryInterface;

class GiftResolver extends AbstractResolver implements QueryInterface
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct(Gift::class, $em);
    }
}
