<?php

namespace App\Repository;

use App\Entity\NatureCommande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method NatureCommande|null find($id, $lockMode = null, $lockVersion = null)
 * @method NatureCommande|null findOneBy(array $criteria, array $orderBy = null)
 * @method NatureCommande[]    findAll()
 * @method NatureCommande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NatureCommandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NatureCommande::class);
    }

    // /**
    //  * @return NatureCommande[] Returns an array of NatureCommande objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NatureCommande
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
