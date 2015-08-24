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

namespace KCMS\Converter;

use KCMS\Models\User;
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
     * @param $json
     * @return User
     * @throws \InvalidArgumentException
     */
    public function convertFromJson($json)
    {
        $decoded = json_decode($json, true);

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
