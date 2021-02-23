<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Article;
use App\Model\Query\ArticleQuery;
use App\Model\Response\PaginatedListInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

class ArticleRepository extends ServiceEntityRepository
{
    use PaginatorTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function findByQuery(ArticleQuery $query): PaginatedListInterface
    {
        /** @var QueryBuilder $qb */
        $qb = $this->createQueryBuilder('article');

        $qb
            ->setMaxResults($query->getPerPage())
            ->setFirstResult($query->getFirstResult())
        ;

        if ($query->getSortBy() && $query->getSortOrder()) {
            $qb->orderBy('article.'.$query->getSortBy(), $query->getSortOrder());
        }

        if (null !== $query->getTitle()) {
            $qb
                ->andWhere($qb->expr()->like($qb->expr()->lower('article.title'), ':title'))
                ->setParameter('title', '%'.mb_strtolower($query->getTitle()).'%')
            ;
        }

        return $this->createPaginatedList($qb, $query);
    }
}
