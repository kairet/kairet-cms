<?php
namespace KCMS\Controller;

use Doctrine\ORM\EntityManager;
use KCMS\Models\User;
use Symfony\Component\HttpFoundation\JsonResponse;

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
        return $this->entityManager->getRepository(User::class)->findAll();
    }

    /**
     * @return JsonResponse
     */
    public function getAllUsersJson()
    {
        return new JsonResponse($this->getAllUsers());
    }

    /**
     * @param $id
     * @return null|User
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function getUser($id)
    {
        return $this->entityManager->find(User::class, $id);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function getUserJson($id)
    {
        return new JsonResponse($found = $this->getUser($id), $found != null ? 200 : 404);
    }
}
