<?php

namespace App\Repository;

use App\Entity\ChoixCommande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ChoixCommande|null find($id, $lockMode = null, $lockVersion = null)
 * @method ChoixCommande|null findOneBy(array $criteria, array $orderBy = null)
 * @method ChoixCommande[]    findAll()
 * @method ChoixCommande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChoixCommandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ChoixCommande::class);
    }

    // /**
    //  * @return ChoixCommande[] Returns an array of ChoixCommande objects
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
    public function findOneBySomeField($value): ?ChoixCommande
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
