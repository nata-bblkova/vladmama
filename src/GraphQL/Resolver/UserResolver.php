<?php

namespace App\GraphQL\Resolver;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Overblog\GraphQLBundle\Definition\Resolver\QueryInterface;

class UserResolver extends AbstractResolver implements QueryInterface
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct(User::class, $em);
    }
}
