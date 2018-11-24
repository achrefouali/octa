<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Symfony\Component\Security\Core\Role\RoleHierarchyInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use App\Traits\BaseEntity;
use Symfony\Component\Security\Core\Role\RoleInterface;

/**
 * Roles
 *
 * @ORM\Table(name="roles")
 * @ORM\Entity(repositoryClass="App\Repository\RoleRepository")
 */
class Role implements RoleInterface
{
    use BaseEntity;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
   /**
     * @ORM\Column(name="name", type="string", length=80, unique=true)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Role", inversedBy="children", fetch="EAGER")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=true)
     * @var Role[]
     */
    private $parent;
    
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Role", mappedBy="parent", fetch="EAGER")
     * @var ArrayCollection|Role[]
     */
    private $children;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Participant", mappedBy="role")
     */
    private $users;


    /**
     * @ORM\Column(name="order_role", type="integer")
     */
    private $order;

    const ROLE_ADMIN =  'ROLE_ADMIN';
   

    /**
     * Constructor
     */
  public function __construct($role = '')
    {
        if (0 !== strlen($role)) {
            $this->name = strtoupper($role);
        }
        $this->users = new ArrayCollection();
        $this->children = new ArrayCollection();
        

    }

    /**
     * @see RoleInterface
     */
    public function getRole()
    {
        return $this->name;
    }
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Get name
     *
     * @return string 
     */    
   public function getName()
    {
        return $this->name;
    }
    /**
     * Set name
     *
     * @param string $label
     * @return Role
     */
    public function setName($name)
    {
        $this->name = $name;
    }


    
    /**
     * Get user
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUser()
    {
        return $this->user;
    }
    
    public function getUsers()
    {
        return $this->users;
    }
    
    /**
     * Add user
     *
     * @param \App\Entity\Participant $user
     * @return Role
     */
    public function addUser($user, $addRoleToUser = true)
    {
        $this->users->add($user);
        $addRoleToUser && $user->addRole($this, false);
    }

        /**
     * Remove user
     *
     * @param \App\Entity\Participant $user
     */
    public function removeUser($user)
    {
        $this->users->removeElement($user);
    }

    public function getChildren()
    {
        return $this->children;
    }

    public function addChildren(Role $child, $setParentToChild = true)
    {
        $this->children->add($child);
        $setParentToChild && $child->setParent($this, false);
    }
    
    public function getDescendant(& $descendants = array())
    {
        foreach ($this->children as $role) {
            $descendants[spl_object_hash($role)] = $role;
            $role->getDescendant($descendants);
        }
        return $descendants;
    }
    
    public function removeChildren(Role $children)
    {
        $this->children->removeElement($children);
    }
    
    public function getParent()
    {
        return $this->parent;
    }

    public function setParent(Role $parent, $addChildToParent = true)
    {
        $addChildToParent && $parent->addChildren($this, false);
        $this->parent = $parent;
    }
    
    public function __toString()
    {
        return $this->name;
    }

    public function getRolesList()
    {
        if ($this->children->count()) {
            $childNameList = array();
            foreach ($this->children as $child) {
                $childNameList[] = $child->getName();
            }
            return sprintf('%s [%s]', $this->name, implode(', ', $childNameList));
        }
        return sprintf('%s', $this->name);
    }

    /**
     * Add children
     *
     * @param \App\Entity\Role $children
     * @return Role
     */
    public function addChild(\App\Entity\Role $children)
    {
        $this->children[] = $children;

        return $this;
    }

    /**
     * Remove children
     *
     * @param \App\Entity\Role $children
     */
    public function removeChild(\App\Entity\Role $children)
    {
        $this->children->removeElement($children);
    }
    

   


    /**
     * Set order
     *
     * @param integer $order
     *
     * @return Role
     */
    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return integer
     */
    public function getOrder()
    {
        return $this->order;
    }
}
