<?php

namespace App\Repository;

use App\Entity\ReservationSupplements;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ReservationSupplements|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReservationSupplements|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReservationSupplements[]    findAll()
 * @method ReservationSupplements[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationSupplementsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ReservationSupplements::class);
    }

//    /**
//     * @return ReservationSupplements[] Returns an array of ReservationSupplements objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ReservationSupplements
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
