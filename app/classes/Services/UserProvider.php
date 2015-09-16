<?php
namespace KCMS\Services;

use Doctrine\ORM\EntityManager;
use KCMS\Models\User;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserProviderInterface
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * UserProvider constructor.
     *
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function loadUserByUsername($username)
    {
        $user = $this->entityManager->getRepository('KCMS\Models\User')->findOneBy(['username' => $username]);

        if ($user === null) {
            throw new UsernameNotFoundException('User "' . $username . '" does not exist"');
        }

        return $user;
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException('Did not get a "User"-instance');
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        return $class === 'KCMS\Models\User';
    }
}
