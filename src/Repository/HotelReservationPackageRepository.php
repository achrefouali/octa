<?php

namespace App\Repository;

use App\Entity\HotelReservationPackage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method HotelReservationPackage|null find($id, $lockMode = null, $lockVersion = null)
 * @method HotelReservationPackage|null findOneBy(array $criteria, array $orderBy = null)
 * @method HotelReservationPackage[]    findAll()
 * @method HotelReservationPackage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HotelReservationPackageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, HotelReservationPackage::class);
    }

//    /**
//     * @return HotelReservationPackage[] Returns an array of HotelReservationPackage objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HotelReservationPackage
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
