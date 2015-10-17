<?php
namespace AppBundle\Manager;

use AppBundle\Models\User;
use AppBundle\Validation\ValidationException;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Validator\Exception\ValidatorException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class UserManager
 *
 * @package AppBundle\Manager
 */
class UserManager
{
    /**
     * @var EntityManager
     */
    private $entityManager;
    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * UserManager constructor.
     *
     * @param EntityManager      $entityManager
     * @param ValidatorInterface $validator
     */
    public function __construct(EntityManager $entityManager, ValidatorInterface $validator)
    {
        $this->entityManager = $entityManager;
        $this->validator = $validator;
    }

    /**
     * @param $id
     *
     * @return User
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     * @throws ResourceNotFoundException
     */
    public function getUser($id)
    {
        /** @var User $user */
        $user = $this->entityManager->find('AppBundle:User', $id);

        if ($user === null) {
            throw new ResourceNotFoundException('Could not find user with id=' . $id);
        }

        return $user;
    }

    /**
     * @return User[]
     */
    public function getAllUsers()
    {
        return $this->entityManager->getRepository('AppBundle:User')->findAll();
    }

    /**
     * @param User $newUser
     *
     * @throws ValidationException
     */
    public function createUser(User $newUser)
    {
        $errors = $this->validator->validate($newUser);

        if ($errors->count() === 0) {
            $this->entityManager->persist($newUser);
            $this->entityManager->flush();
        } else {
            throw new ValidationException('Validation failed, errors: ' . (string) $errors);
        }
    }

    /**
     * @param User $toBeDeletedUser
     */
    public function deleteUser(User $toBeDeletedUser)
    {
        var_dump($toBeDeletedUser);
        $this->entityManager->remove($toBeDeletedUser);
        $this->entityManager->flush();
    }
}
