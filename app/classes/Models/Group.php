<?php
namespace KCMS\Models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Group
 *
 * @package KCMS\Models
 * @ORM\Entity
 * @ORM\Table(name="groups")
 */
class Group implements \JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\Column(name="name", type="string", length=20)
     * @Assert\Length(max=20)
     * @Assert\Regex(pattern="/[A-Z]+/")
     * @var string
     */
    protected $name;

    /**
     * @ORM\Column(name="description", type="string", length=255)
     * @Assert\Length(max=255)
     * @var string
     */
    protected $description;

    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="groups", cascade={"persist"})
     * @var User[]
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return User[]
     */
    public function getUsers()
    {
        return $this->users;
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

    public function jsonSerialize()
    {
        return [
            'name'        => $this->name,
            'description' => $this->description
        ];
    }
}
