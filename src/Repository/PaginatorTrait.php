<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\Query\SimpleQueryInterface;
use App\Model\Response\PaginatedList;
use App\Model\Response\PaginatedListInterface;
use function ceil;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;

trait PaginatorTrait
{
    public function findByQuery(SimpleQueryInterface $query): PaginatedListInterface
    {
        /** @var QueryBuilder $qb */
        $qb = $this->createQueryBuilder('entity');

        $qb
            ->setMaxResults($query->getPerPage())
            ->setFirstResult($query->getFirstResult())
        ;

        if ($query->getSortBy() && $query->getSortOrder()) {
            $qb->orderBy('entity.'.$query->getSortBy(), $query->getSortOrder());
        }

        return $this->createPaginatedList($qb, $query);
    }

    protected function createPaginatedList(QueryBuilder $qb, SimpleQueryInterface $query): PaginatedListInterface
    {
        $paginator = new Paginator($qb);
        $dbQuery = $paginator->getQuery();

        $totalPages = (int) ceil($paginator->count() / $query->getPerPage());

        return new PaginatedList(
            $paginator->count(),
            $totalPages,
            $dbQuery->getResult()
        );
    }
}
