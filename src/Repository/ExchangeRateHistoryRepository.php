<?php

namespace App\Repository;

use App\Entity\Currency;
use App\Entity\ExchangeRateHistory;
use App\Form\Model\CurrencySearchModel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ExchangeRateHistory|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExchangeRateHistory|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExchangeRateHistory[]    findAll()
 * @method ExchangeRateHistory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExchangeRateHistoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExchangeRateHistory::class);
    }

    /**
     * @param CurrencySearchModel $model
     * @return Currency[] Returns an array of Currency objects
     */
    public function findBySearchModel(CurrencySearchModel $model)
    {
        return $this->createQueryBuilder('er')
            ->select('er')
            ->where('er.currency IN(:currencyIds)')
            ->setParameter('currencyIds', $model->getCurrencyIds())
            ->andWhere('er.effectiveDate >= :dateFrom')
            ->setParameter('dateFrom', $model->getFormattedDateFrom())
            ->andWhere('er.effectiveDate <= :dateTo')
            ->setParameter('dateTo', $model->getFormattedDateTo())
            ->orderBy('er.currency.code', 'ASC')
            ->orderBy('er.effectiveDate', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

    /*
    public function findOneBySomeField($value): ?ExchangeRateHistory
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
