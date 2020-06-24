<?php

namespace App\Repository;

use App\Entity\Ecoscore;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Ecoscore|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ecoscore|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ecoscore[]    findAll()
 * @method Ecoscore[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EcoscoreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ecoscore::class);
    }

    // /**
    //  * @return Ecoscore[] Returns an array of Ecoscore objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ecoscore
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
