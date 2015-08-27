<?php
/*************************************************************************
 * Copyright (C) 2015 kairet                                             *
 *                                                                       *
 * This program is free software: you can redistribute it and/or modify  *
 * it under the terms of the GNU General Public License as published by  *
 * the Free Software Foundation, either version 3 of the License, or     *
 * (at your option) any later version.                                   *
 *                                                                       *
 * This program is distributed in the hope that it will be useful,       *
 * but WITHOUT ANY WARRANTY; without even the implied warranty of        *
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         *
 * GNU General Public License for more details.                          *
 *                                                                       *
 * You should have received a copy of the GNU General Public License     *
 * along with this program.  If not, see <http://www.gnu.org/licenses/>. *
 *************************************************************************/

namespace KCMS\Models;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use KCMS\Validation\ValidationException;
use KCMS\Validation\ValidationHelper;
use KCMS\Validation\ValidationInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class User
 * @package KCMS\Models
 * @ORM\Entity
 * @ORM\Table(name="users")
 * @ORM\HasLifecycleCallbacks
 */
class User implements \JsonSerializable, ValidationInterface
{
    /**
     * @ORM\Id @ORM\GeneratedValue @ORM\Column(type="integer")
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @var string
     */
    protected $username;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @var string
     */
    protected $firstName;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @var string
     */
    protected $lastName;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Assert\Email
     * @var string
     */
    protected $email;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Assert\Length(min=5)
     * @var string
     */
    protected $password;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank()
     * @Assert\DateTime()
     * @var DateTime
     */
    protected $createdDate;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank()
     * @Assert\DateTime()
     * @var DateTime
     */
    protected $editedDate;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @var User
     */
    protected $createdBy;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @var User
     */
    protected $editedBy;

    /**
     * @ORM\ManyToMany(targetEntity="Group", inversedBy="users", cascade={"persist"})
     * @var Group[]
     */
    private $groups;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->groups = new ArrayCollection();
    }

    /**
     * User-factory
     * @param $username
     * @param $firstName
     * @param $lastName
     * @param $email
     * @param $password
     * @return User
     */
    public static function createUser($username, $firstName, $lastName, $email, $password)
    {
        $user = new User();
        $user->username = $username;
        $user->firstName = $firstName;
        $user->lastName = $lastName;
        $user->email = $email;
        $user->password = $password;

        return $user;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return DateTime
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * @param DateTime $createdDate
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;
    }

    /**
     * @return DateTime
     */
    public function getEditedDate()
    {
        return $this->editedDate;
    }

    /**
     * @param DateTime $editedDate
     */
    public function setEditedDate($editedDate)
    {
        $this->editedDate = $editedDate;
    }

    /**
     * @return User
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @param User $createdBy
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;
    }

    /**
     * @return User
     */
    public function getEditedBy()
    {
        return $this->editedBy;
    }

    /**
     * @param User $editedBy
     */
    public function setEditedBy($editedBy)
    {
        $this->editedBy = $editedBy;
    }

    /**
     * @return Group[]
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * @param Group $group
     */
    public function addToGroup(Group $group)
    {
        $this->groups[] = $group;
    }

    /**
     * @param Group $group
     */
    public function removeFromGroup(Group $group)
    {
        $this->groups->removeElement($group);
    }

    /**
     * (PHP 5 &gt;= 5.4.0)<br/>
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     */
    public function jsonSerialize()
    {
        return [
            "username"    => $this->username,
            "firstName"   => $this->firstName,
            "lastName"    => $this->lastName,
            "email"       => $this->email,
            "createdDate" => $this->createdDate,
            "editedDate"  => $this->editedDate,
            "createdBy"   => $this->createdBy,
            "editedBy"    => $this->editedBy,
            "groups"      => $this->groups->toArray()
        ];
    }

    /**
     * Validate an object, throw {@see ValidationException} if invalid
     * @ORM\PrePersist @ORM\PreUpdate
     * @throws ValidationException
     */
    public function validate()
    {
        ValidationHelper::validate($this);
    }
}
