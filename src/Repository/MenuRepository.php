<?php

namespace App\Repository;

use App\Entity\Menu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Menu|null find($id, $lockMode = null, $lockVersion = null)
 * @method Menu|null findOneBy(array $criteria, array $orderBy = null)
 * @method Menu[]    findAll()
 * @method Menu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MenuRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Menu::class);
    }

    /**
     * @return Menu[] Returns an array of Menu objects
     */
    public function findAll($enabled = true)
    {
         $builder = $this->createQueryBuilder('m');
            if($enabled) {
                $builder ->andWhere('m.enabled = :enabled')
                         ->setParameter('enabled', 1);
            }

        return $builder ->orderBy('m.order', 'ASC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;

    }


    /*
    public function findOneBySomeField($value): ?Menu
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
