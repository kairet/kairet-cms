<?php
namespace KCMS\Converter;

use KCMS\Models\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

/**
 * Class UserConverter
 * @package KCMS\Converter
 */
class UserConverter extends AbstractConverter
{
    /**
     * @param $id
     * @return User
     * @throws ResourceNotFoundException
     */
    public function convertFromId($id)
    {
        $foundUser = $this->entityManager->getRepository('KCMS\Models\User')->find($id);
        if ($foundUser === null) {
            throw new ResourceNotFoundException('User with id ' . $id . ' could not be found.', 404);
        }

        return $foundUser;
    }

    /**
     * @param         $null
     * @param Request $request
     * @return User
     */
    public function convertFromRequestBody($null, Request $request)
    {
        $decoded = json_decode($request->getContent(), true);

        $user = User::createUser(
            $decoded['username'] ?: null,
            $decoded['firstName'] ?: null,
            $decoded['lastName'] ?: null,
            $decoded['email'] ?: null,
            $decoded['password'] ?: null
        );

        if ($user === null) {
            throw new \InvalidArgumentException('User could not be created, invalid arguments.', 400);
        } else {
            return $user;
        }
    }
}
