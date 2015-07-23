<?php
namespace KCMS\Models;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Group
 * @package KCMS\Models
 * @Entity @Table(name="groups")
 */
class Group
{
    /**
     * @Id @GeneratedValue @Column(type="integer")
     * @var int
     */
    protected $id;

    /**
     * @Column(type="string")
     * @var string
     */
    protected $groupName;

    /**
     * @ManyToMany(targetEntity="User", mappedBy="groups", cascade={"persist"})
     */
    private $users;

    /**
     * Group constructor.
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getGroupName()
    {
        return $this->groupName;
    }

    /**
     * @param string $groupName
     */
    public function setGroupName($groupName)
    {
        $this->groupName = $groupName;
    }

    /**
     * @param User $user
     */
    public function addUser(User $user)
    {
        $this->users[] = $user;
    }

    /**
     * @param User $user
     */
    public function removeUser(User $user)
    {
        $this->users->removeElement($user);
    }
}
