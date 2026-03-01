<?php

namespace App\GraphQL\Resolver;

use App\Entity\Institution;
use Doctrine\ORM\EntityManagerInterface;
use Overblog\GraphQLBundle\Definition\Resolver\QueryInterface;

class InstitutionResolver extends AbstractResolver implements QueryInterface
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct(Institution::class, $em);
    }
}
