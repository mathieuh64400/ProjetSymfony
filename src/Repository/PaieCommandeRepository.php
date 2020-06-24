<?php

namespace App\Repository;

use App\Entity\PaieCommande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PaieCommande|null find($id, $lockMode = null, $lockVersion = null)
 * @method PaieCommande|null findOneBy(array $criteria, array $orderBy = null)
 * @method PaieCommande[]    findAll()
 * @method PaieCommande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaieCommandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PaieCommande::class);
    }

    // /**
    //  * @return PaieCommande[] Returns an array of PaieCommande objects
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
    public function findOneBySomeField($value): ?PaieCommande
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
