<?php
namespace KCMS\Services;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Tools\Setup;
use KCMS\Config;

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
}
