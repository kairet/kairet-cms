<?php
namespace KCMS\Models;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use KCMS\Validation\RegexBank;
use KCMS\Validation\Rules\String\StringNotEmpty;
use KCMS\Validation\Rules\String\StringRegex;
use KCMS\Validation\Rules\Type\IsString;
use KCMS\Validation\ValidationException;
use KCMS\Validation\ValidationHelper;
use KCMS\Validation\ValidationInterface;

/**
 * Class User
 * @package KCMS\Models
 * @Entity
 * @Table(name="users")
 * @HasLifecycleCallbacks
 */
class User implements \JsonSerializable, ValidationInterface
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
    protected $username;

    /**
     * @Column(type="string")
     * @var string
     */
    protected $firstName;

    /**
     * @Column(type="string")
     * @var string
     */
    protected $lastName;

    /**
     * @Column(type="string")
     * @var string
     */
    protected $email;

    /**
     * @Column(type="string")
     * @var string
     */
    protected $password;

    /**
     * @Column(type="datetime")
     * @var DateTime
     */
    protected $createdDate;

    /**
     * @Column(type="datetime")
     * @var DateTime
     */
    protected $editedDate;

    /**
     * @ManyToOne(targetEntity="User")
     * @var User
     */
    protected $createdBy;

    /**
     * @ManyToOne(targetEntity="User")
     * @var User
     */
    protected $editedBy;

    /**
     * @ManyToMany(targetEntity="Group", inversedBy="users", cascade={"persist"})
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
            "username"  => $this->username,
            "firstname" => $this->firstName,
            "lastname"  => $this->lastName
        ];
    }

    /**
     * @throws ValidationException
     * @return void
     * @PrePersist @PreUpdate
     */
    public function validate()
    {
        ValidationHelper::validate($this->username, [new IsString(), new StringNotEmpty()], "Username");
        ValidationHelper::validate($this->firstName, [new IsString(), new StringNotEmpty()], "Firstname");
        ValidationHelper::validate($this->lastName, [new IsString(), new StringNotEmpty()], "Lastname");
        ValidationHelper::validate(
            $this->email,
            [new IsString(), new StringNotEmpty(), new StringRegex(RegexBank::EMAIL)],
            "Email"
        );
    }
}
