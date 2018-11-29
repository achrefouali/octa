<?php
/**
 * Created by PhpStorm.
 * User: acf
 * Date: 30/11/2018
 * Time: 00:13
 */

namespace App\Repository;


use Doctrine\ORM\EntityRepository;

class ReservationRepository extends EntityRepository
{

    public function findReservationOrder(){
             $state=[1,2];
        $query= $this->createQueryBuilder('p');
            $query->select('p')
                ->andWhere('p.state IN (:state)')
                ->setParameter('state',$state)
                ->orderBy('p.dateArrive','ASC');
            ;
        return $query->getQuery()->getResult();
    }
    public function findReservationDepartOrder(){
        $state=[1,2];
        $query= $this->createQueryBuilder('p');
        $query->select('p')
            ->andWhere('p.state IN (:state)')
            ->setParameter('state',$state)
            ->orderBy('p.dateDepart','ASC');
        ;
        return $query->getQuery()->getResult();
    }
}