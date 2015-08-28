<?php
namespace KCMS\Tests;

use Doctrine\ORM\ORMException;
use KCMS\Services\ServiceContext;

class DbTest extends \PHPUnit_Framework_TestCase
{
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
}
