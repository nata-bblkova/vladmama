<?php

namespace App\GraphQL\Resolver;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ObjectRepository;
use Overblog\GraphQLBundle\Definition\Resolver\QueryInterface;

abstract class AbstractResolver implements QueryInterface
{
    protected EntityManagerInterface $em;

    protected ObjectRepository $repository;

    protected string $entityClassName;

    public function __construct(
        string $entityClassName,
        EntityManagerInterface $em,
    ) {
        $this->entityClassName = $entityClassName;
        $this->em              = $em;
        $this->repository      = $em->getRepository($entityClassName);
    }

    public function resolve(int $id, string $entityAlias = 'alias'): ?object
    {
        $qb = $this->repository->createQueryBuilder($entityAlias);

        $qb
            ->where("{$entityAlias}.id = :id")
            ->setParameter('id', $id)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function resolveList(string $entityAlias = 'alias'): array
    {
        $qb = $this->repository->createQueryBuilder($entityAlias);

        return $qb->getQuery()->getResult();
    }
}
