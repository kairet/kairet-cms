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
     */
    public function createUser(User $user)
    {
        $user->setCreatedDate(new \DateTime());
        $user->setEditedDate(new \DateTime());
        $this->entityManager->persist($user);
        $this->entityManager->flush();
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
