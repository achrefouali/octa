<?php

namespace App\Security\Roles;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Role\RoleHierarchyInterface;

/**
 * RoleHierarchy defines a role hierarchy.
 *
 * @author Amairia Aymen <aymen.amairia@wevioo.com>
 */
class RoleHierarchy implements RoleHierarchyInterface
{
    /**
     *
     * @var \namespace App\Entity\Role[]
     */
   // private $hierarchy;
    private $parents;

    /**
     * Constructor.
     *
     * @param array $hierarchy An array defining the hierarchy
     */
    public function __construct(EntityManager $em)
    {
        // Debug Tool Bar triggers this construct 12 times, only in dev.
        //$this->hierarchy = $em->getRepository('App:Role')->findAllWithSons();
//        $this->buildRoleMap();
        $this->hierarchy = [];
    }

    /**
     * {@inheritdoc}
     */
    public function getReachableRoles(array $roles)
    {
        $reachableRoles = array();
        foreach ($roles as $role) {
            $reachableRoles[spl_object_hash($role)] = $role;
            if (!isset($this->parents[$role->getRole()])) {
                continue;
            }
            $this->parents[$role->getRole()]->getDescendant($reachableRoles);
        }
        
        return array_values($reachableRoles);
    }

    protected function buildRoleMap()
    {
        $this->parents = array();
        foreach ($this->hierarchy as $role) {
            if ($role->getChildren()->count()) {
                $this->parents[$role->getRole()] = $role;
            }
        }
    }
}
