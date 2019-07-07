<?php

namespace App\Repository;

use App\Entity\InvestmentFund;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method InvestmentFund|null find($id, $lockMode = null, $lockVersion = null)
 * @method InvestmentFund|null findOneBy(array $criteria, array $orderBy = null)
 * @method InvestmentFund[]    findAll()
 * @method InvestmentFund[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InvestmentFundRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, InvestmentFund::class);
    }

    // /**
    //  * @return InvestmentFund[] Returns an array of InvestmentFund objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?InvestmentFund
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
