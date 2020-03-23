<?php

namespace App\Repository;

use App\Entity\Barrow;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Barrow|null find($id, $lockMode = null, $lockVersion = null)
 * @method Barrow|null findOneBy(array $criteria, array $orderBy = null)
 * @method Barrow[]    findAll()
 * @method Barrow[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BarrowRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Barrow::class);
    }

    // /**
    //  * @return Barrow[] Returns an array of Barrow objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Barrow
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
