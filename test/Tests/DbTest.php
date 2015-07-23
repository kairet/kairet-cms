<?php
namespace KCMS\Tests;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use KCMS\Database\DbService;
use KCMS\Models\User;

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
            $em = DbService::getEntityManager();
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
