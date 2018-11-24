<?php

namespace App\Repository;

use App\Entity\HotelPackage;
use App\Entity\HotelPackagePeriode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method HotelPackagePeriode|null find($id, $lockMode = null, $lockVersion = null)
 * @method HotelPackagePeriode|null findOneBy(array $criteria, array $orderBy = null)
 * @method HotelPackagePeriode[]    findAll()
 * @method HotelPackagePeriode[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HotelPackagePeriodeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, HotelPackagePeriode::class);
    }



    public function getPackagePeriodeByDate(\DateTime $date, HotelPackage $package){


        return $this->createQueryBuilder('p')
            ->where(':date >= p.dateDebut')
            ->andWhere(':date <= p.dateFin')
            ->andWhere('p.package = :package')
            ->andWhere('p.enabled = :enabled')
            ->setParameter('date', $date->format('Y-m-d'))
            ->setParameter('package', $package->getId())
            ->setParameter('enabled', true)
            ->getQuery()->getResult();

    }


//    /**
//     * @return HotelPackagePeriode[] Returns an array of HotelPackagePeriode objects
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
    public function findOneBySomeField($value): ?HotelPackagePeriode
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
