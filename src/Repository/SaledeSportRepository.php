<?php

namespace App\Repository;

use App\Entity\Saledesport;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SaledeSport|null find($id, $lockMode = null, $lockVersion = null)
 * @method SaledeSport|null findOneBy(array $criteria, array $orderBy = null)
 * @method SaledeSport[]    findAll()
 * @method SaledeSport[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SaledeSportRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SaledeSport::class);
    }

    // /**
    //  * @return SaledeSport[] Returns an array of SaledeSport objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SaledeSport
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
