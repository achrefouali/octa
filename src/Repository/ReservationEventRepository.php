<?php

namespace App\Repository;

use App\Entity\ReservationEvent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ReservationEvent|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReservationEvent|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReservationEvent[]    findAll()
 * @method ReservationEvent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationEventRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ReservationEvent::class);
    }

//    /**
//     * @return ReservationEvent[] Returns an array of ReservationEvent objects
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
    public function findOneBySomeField($value): ?ReservationEvent
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


    public function findListParticipants($id)
    {
        $state=[1,2];
        $query= $this->createQueryBuilder('p');
            $query->select('DISTINCT  participant.id')
                ->innerJoin('p.reservation','reservation')
            ->innerJoin('p.event','event')
            ->innerJoin('reservation.participant','participant')
                ->andWhere('reservation.state IN (:state)')
                ->setParameter('state',$state)
            ->andWhere('event.id =:id')
                ->setParameter('id',$id)
            ->innerJoin('participant.type', 't')
            ->andWhere('t.label = :type')
            ->setParameter('type', 'Participant')
            ;
        return $query->getQuery()->getResult();
    }
}





