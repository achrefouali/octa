<?php

namespace App\Repository;

use App\Entity\HotelPackage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method HotelPackage|null find($id, $lockMode = null, $lockVersion = null)
 * @method HotelPackage|null findOneBy(array $criteria, array $orderBy = null)
 * @method HotelPackage[]    findAll()
 * @method HotelPackage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HotelPackageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, HotelPackage::class);
    }

//    /**
//     * @return HotelPackage[] Returns an array of HotelPackage objects
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
    public function findOneBySomeField($value): ?HotelPackage
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
