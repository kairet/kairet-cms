<?php
namespace KCMS\Controller;

use Doctrine\ORM\EntityManager;
use KCMS\Models\User;

/**
 * Class UserController
 * @package KCMS\Controller
 */
class UserController
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * UserController constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return User[]|null
     */
    public function getAllUsers()
    {
        return $this->entityManager->getRepository('KCMS\Models\User')->findAll();
    }

    /**
     * @param User $user
     * @return User
     */
    public function getUser(User $user)
    {
        return $user;
    }

    /**
     * @param User $user
     * @return User
     */
    public function createUser(User $user)
    {
        $user->setCreatedDate(new \DateTime());
        $user->setEditedDate(new \DateTime());
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }

    /**
     * @param User $user
     */
    public function deleteUser(User $user)
    {
        $this->entityManager->remove($user);
        $this->entityManager->flush();
    }
}
