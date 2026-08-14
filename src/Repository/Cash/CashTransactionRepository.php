<?php

namespace App\Repository\Cash;

use App\Entity\Cash\CashTransaction;
use App\Repository\Core\CoreRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

class CashTransactionRepository extends ServiceEntityRepository implements CoreRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CashTransaction::class);
    }

    public function getPaginatedQuery(array $searchFormData = []): Query
    {
        $qb = $this->createQueryBuilder('ct')
            ->leftJoin('ct.createdBy', 'u');

        // Търсене по дата на транзакция
        if (!empty($searchFormData['transactionDateFrom'])) {
            $qb->andWhere('ct.transactionDate >= :transactionDateFrom')
               ->setParameter('transactionDateFrom', $searchFormData['transactionDateFrom']);
        }

        if (!empty($searchFormData['transactionDateTo'])) {
            $qb->andWhere('ct.transactionDate <= :transactionDateTo')
               ->setParameter('transactionDateTo', $searchFormData['transactionDateTo']);
        }

        // Търсене по сума
        if (!empty($searchFormData['amountFrom'])) {
            $qb->andWhere('ct.amount >= :amountFrom')
               ->setParameter('amountFrom', $searchFormData['amountFrom']);
        }

        if (!empty($searchFormData['amountTo'])) {
            $qb->andWhere('ct.amount <= :amountTo')
               ->setParameter('amountTo', $searchFormData['amountTo']);
        }

        // Търсене по тип транзакция
        if (!empty($searchFormData['transactionType'])) {
            $qb->andWhere('ct.transactionType = :transactionType')
               ->setParameter('transactionType', $searchFormData['transactionType']);
        }

        // Търсене по създател
        if (!empty($searchFormData['createdBy'])) {
            $qb->andWhere('u.name LIKE :createdBy OR u.family LIKE :createdBy')
               ->setParameter('createdBy', '%' . $searchFormData['createdBy'] . '%');
        }

        // Сортиране по дата на транзакция (най-новите първи)
        $qb->orderBy('ct.transactionDate', 'DESC')
            ->addOrderBy('ct.createdAt', 'DESC');

        return $qb->getQuery();
    }
} 