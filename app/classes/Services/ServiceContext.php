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

namespace KCMS\Services;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Tools\Setup;
use KCMS\Config;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Provides access to service instances using singletons
 * @package KCMS\Services
 */
class ServiceContext
{
    /**
     * @var \PDO
     */
    private static $pdo = null;

    /**
     * @var EntityManager
     */
    private static $entityManager = null;

    /**
     * @var ValidatorInterface
     */
    private static $validator;

    /**
     * Retrieves a new or existing PDO-Object for database connection using parameters in {@see Config}
     * @return \PDO
     * @throws \RuntimeException
     */
    public static function getPdoDatabase()
    {
        if (ServiceContext::$pdo == null) {
            try {
                $dsn = Config::DB_DRIVER . ":host=" . Config::DB_HOST . ";port=" . Config::DB_PORT . ";dbname=" .
                       Config::DB_NAME;

                ServiceContext::$pdo = new \PDO(
                    $dsn,
                    Config::DB_USER,
                    Config::DB_PASS
                );
            } catch (\Exception $e) {
                throw new \RuntimeException("Unable to connect to database", 0, $e);
            }
        }

        return ServiceContext::$pdo;
    }

    /**
     * Retrieves a {@see EntityManager} instance using the parameters in {@see Config}
     * @return EntityManager
     * @throws ORMException
     */
    public static function getEntityManager()
    {
        if (ServiceContext::$entityManager == null) {
            $config = Setup::createAnnotationMetadataConfiguration(
                [__DIR__ . "/../Models"],
                Config::DEV_MODE,
                null,
                null,
                false
            );

            $conn = [
                'driver'   => Config::DB_DRIVER,
                'host'     => Config::DB_HOST,
                'dbname'   => Config::DB_NAME,
                'user'     => Config::DB_USER,
                'password' => Config::DB_PASS
            ];

            ServiceContext::$entityManager = EntityManager::create($conn, $config);
        }

        return ServiceContext::$entityManager;
    }

    /**
     * Retrieves a Symfony\Validator-instance
     * @return ValidatorInterface
     */
    public static function getValidator()
    {
        if (ServiceContext::$validator == null) {
            ServiceContext::$validator = Validation::createValidatorBuilder()
                ->enableAnnotationMapping()
                ->getValidator();
        }
        return ServiceContext::$validator;
    }
}
