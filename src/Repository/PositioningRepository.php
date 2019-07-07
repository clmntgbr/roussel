<?php

namespace App\Repository;

use App\Entity\Positioning;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Positioning|null find($id, $lockMode = null, $lockVersion = null)
 * @method Positioning|null findOneBy(array $criteria, array $orderBy = null)
 * @method Positioning[]    findAll()
 * @method Positioning[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PositioningRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Positioning::class);
    }

    // /**
    //  * @return Positioning[] Returns an array of Positioning objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Positioning
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
