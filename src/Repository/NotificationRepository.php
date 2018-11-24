<?php

namespace App\Repository;


use App\Entity\Notification;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Notification|null find($id, $lockMode = null, $lockVersion = null)
 * @method Notification|null findOneBy(array $criteria, array $orderBy = null)
 * @method Notification[]    findAll()
 * @method Notification[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NotificationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Notification::class);
    }

    /**
     * findRecordsByFilter
     * This function allow to find filter
     * @param $filter
     * @param string $sort
     * @param string $orderBy
     * @param bool $paginator
     * @return array|\Doctrine\ORM\Query
     */
    public function findRecordsByFilter($filter, $sort = 'id', $orderBy = 'ASC', $paginator = false) 
    {

        $queryBuilder = $this->createQueryBuilder('n');

        $queryBuilder->select('n');

        if ((isset($filter['subject']) && !empty($filter['subject']))) {
            $queryBuilder->andWhere('n.subject  LIKE :subject')->setParameter('subject', '%' . $filter['subject'] . '%');
        }

        if ((isset($filter['notificationType']))) {
            $queryBuilder->andWhere('n.notificationType = :notificationType')->setParameter('notificationType',  $filter['notificationType']);
        }
      
        if ((isset($filter['id']) && !empty($filter['id']))) {
            $queryBuilder->andWhere('n.id = :id')->setParameter('id',  $filter['id']);
        }

        $queryBuilder->orderBy('n.'.$sort, $orderBy);

        if($paginator == false){
            $result =  $queryBuilder->getQuery()->getResult();
        }else{
            $result =  $queryBuilder->getQuery();
        }

        return ['total_result' => count($queryBuilder->getQuery()->getResult()) , 'result' => $result];
    }
}
