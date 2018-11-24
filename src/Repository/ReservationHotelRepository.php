<?php

namespace App\Repository;

use App\Entity\ReservationHotel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ReservationHotel|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReservationHotel|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReservationHotel[]    findAll()
 * @method ReservationHotel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationHotelRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ReservationHotel::class);
    }

//    /**
//     * @return ReservationHotel[] Returns an array of ReservationHotel objects
//     */
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
    public function findOneBySomeField($value): ?ReservationHotel
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
