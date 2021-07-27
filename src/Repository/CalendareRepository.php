<?php

namespace App\Repository;

use App\Entity\Calendare;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Calendare|null find($id, $lockMode = null, $lockVersion = null)
 * @method Calendare|null findOneBy(array $criteria, array $orderBy = null)
 * @method Calendare[]    findAll()
 * @method Calendare[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CalendareRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Calendare::class);
    }

    // /**
    //  * @return Calendare[] Returns an array of Calendare objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Calendare
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
