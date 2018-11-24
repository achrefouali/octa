<?php

namespace App\Repository;

use App\Entity\Accompanying;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Accompanying|null find($id, $lockMode = null, $lockVersion = null)
 * @method Accompanying|null findOneBy(array $criteria, array $orderBy = null)
 * @method Accompanying[]    findAll()
 * @method Accompanying[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AccompanyingRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Accompanying::class);
    }

//    /**
//     * @return Accompanying[] Returns an array of Accompanying objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Accompanying
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
