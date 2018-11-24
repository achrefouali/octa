<?php

// src/Application/UserBundle/DataFixtures/ORM/LoadRoleHierarchy.php

namespace App\DataFixtures\ORM;


use App\DataFixtures\AbstractDataFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


use App\Entity\Role;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

class LoadRoleHierarchy extends AbstractDataFixture implements OrderedFixtureInterface, ContainerAwareInterface
{


    /**
     * @return array
     */
    public function getEnvironments()
    {
        return ['prod', 'test', 'dev'];
    }


    public function getOrder() {
        return 1;
    }

    public function doLoad(ObjectManager $manager) {


        $roles = array(
            0 => array(//ROLE ADMIN
                'name' => 'ROLE_ADMIN',
                'parent' => null,
                'order' => 1
            ),
            1 => array(//ROLE_USER
                'name' => 'ROLE_USER',
                'parent' => null,
                'order' => 2
            )
        );

        //Create Roles Hierachy
        foreach ($roles as $key => $role_item) {
            $role = new Role();
            $parent = null;
            //check parrent
            if (!is_null($role_item['parent']) && $this->hasReference($role_item['parent'])) {
                $parent = $this->getReference($role_item['parent']);
                $role->setParent($parent);
            }
            $role->setName($role_item['name']);
            $role->setOrder($role_item['order']);


            $manager->persist($role);
            $this->addReference($role_item['name'], $role);
        }
        $manager->flush();
    }

}
