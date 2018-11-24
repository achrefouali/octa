<?php

namespace App\Repository;


    use App\Entity\Pattern;
    use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
    use Symfony\Bridge\Doctrine\RegistryInterface;

    /**
     * @method Pattern|null find($id, $lockMode = null, $lockVersion = null)
     * @method Pattern|null findOneBy(array $criteria, array $orderBy = null)
     * @method Pattern[]    findAll()
     * @method Pattern[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
     */
class PatternRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Pattern::class);
    }
    
  function findPatternByNotification($notification, $filter= array()) {
        
        $qb = $this->createQueryBuilder('p');
        $qb->add('select', 'p');
        $qb->where('p.notification  = :notification_id')->setParameter('notification_id', '%' . $notification . '%');
     
        if ((isset($filter['notificationType']) && !empty($filter['notificationType']))) {
            $qb->andWhere('p.notificationType = :notificationType')->setParameter('notificationType',  $filter['notificationType']);
        }

        return $qb->getQuery()->getResult();
    }


}
