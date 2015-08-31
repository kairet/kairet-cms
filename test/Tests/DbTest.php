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
