<?php

namespace App\GraphQL\Resolver;

use App\Entity\Child;
use Doctrine\ORM\EntityManagerInterface;
use Overblog\GraphQLBundle\Definition\Resolver\QueryInterface;

class ChildResolver extends AbstractResolver implements QueryInterface
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct(Child::class, $em);
    }
}
