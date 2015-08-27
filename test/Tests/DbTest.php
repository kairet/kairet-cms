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

namespace KCMS\Tests;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use KCMS\Models\User;
use KCMS\Services\ServiceContext;

class DbTest extends \PHPUnit_Framework_TestCase
{
    const TEST_USER_NAME = "test.user";

    /**
     * Tests if a connection to the database can be established using {@see DbService::getEntityManager}
     */
    public function testDbConnection()
    {
        $em = null;

        try {
            $em = ServiceContext::getEntityManager();
        } catch (ORMException $e) {
            $this->fail($e->getMessage());
        }

        return $em;
    }

    /**
     * Tests adding a new user to the database
     * @depends testDbConnection
     * @param EntityManager $em
     * @return EntityManager
     */
    public function testAddNewUser(EntityManager $em)
    {
        try {
            $newUser = new User();
            $newUser->setUsername(DbTest::TEST_USER_NAME);
            $newUser->setFirstName("Test");
            $newUser->setLastName("User");
            $newUser->setEmail("test@test.com");
            $newUser->setPassword("12345");
            $newUser->setCreatedDate(new \DateTime());
            $newUser->setEditedDate(new \DateTime());

            $em->persist($newUser);
            $em->flush();
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }

        return $em;
    }

    /**
     * Tests retrieving the new user from the database
     * @depends testAddNewUser
     * @param EntityManager $em
     */
    public function testRetrieveAddedUser(EntityManager $em)
    {
        try {
            /** @var User $result */
            $result = $em->find('KCMS\Models\User', 1);
            $this->assertInstanceOf('KCMS\Models\User', $result);
            $this->assertEquals(DbTest::TEST_USER_NAME, $result->getUsername());
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }
    }
}
