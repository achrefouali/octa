<?php

namespace App\Repository;

use App\Entity\Role;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * RoleRepository Class
 *
 * @author Amairia Aymen <aymen.amairia@wevioo.com>
 */
class RoleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Role::class);
    }
    /**
     * Gets Roles withou parents i.e. Root Roles. 
     * 
     * @return array
     */
    public function getRootRoles()
    {
        return $this->createQueryBuilder('r')
            ->where('r.parent IS NULL')
            ->getQuery()
            ->execute();
    }
    
    /**
     * Prevents lots of lazy loading queries when making Roles hierarchy.
     * 
     * @return array
     */
    public function findAllWithSons()
    {
        return $this->createQueryBuilder('r')
            ->leftJoin('r.children', 'p')
            ->select('r, p')    
            ->getQuery()
            ->execute();
    }
    
    /**
     * GET ROLE USER
     */
    
    
   public function getRolesForm($user){

       return $this->createQueryBuilder('r');
   }
   public function getRolesByName($names){

       $qb= $this->createQueryBuilder('r')
            ->where('r.name in (:name)')->setParameter('name', $names);
       return $qb->getQuery()->getResult();
   }
}
