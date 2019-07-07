<?php

namespace App\Repository;

use App\Entity\FundsUnderManagement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method FundsUnderManagement|null find($id, $lockMode = null, $lockVersion = null)
 * @method FundsUnderManagement|null findOneBy(array $criteria, array $orderBy = null)
 * @method FundsUnderManagement[]    findAll()
 * @method FundsUnderManagement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FundsUnderManagementRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, FundsUnderManagement::class);
    }

    // /**
    //  * @return FundsUnderManagement[] Returns an array of FundsUnderManagement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FundsUnderManagement
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
