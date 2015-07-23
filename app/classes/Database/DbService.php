<?php
namespace KCMS\Database;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Tools\Setup;
use KCMS\Config;

class DbService
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
        if (DbService::$pdo == null) {
            try {
                $dsn = Config::DB_DRIVER . ":host=" . Config::DB_HOST . ";port=" . Config::DB_PORT . ";dbname=" .
                       Config::DB_NAME;

                DbService::$pdo = new \PDO(
                    $dsn,
                    Config::DB_USER,
                    Config::DB_PASS
                );
            } catch (\Exception $e) {
                throw new \RuntimeException("Unable to connect to database", 0, $e);
            }
        }

        return DbService::$pdo;
    }

    /**
     * Retrieves a {@see EntityManager} instance using the parameters in {@see Config}
     * @return EntityManager
     * @throws ORMException
     */
    public static function getEntityManager()
    {
        if (DbService::$entityManager == null) {
            $config = Setup::createAnnotationMetadataConfiguration(
                [__DIR__ . "/../Models"],
                Config::DEV_MODE
            );

            $conn = [
                'driver'   => Config::DB_DRIVER,
                'host'     => Config::DB_HOST,
                'dbname'   => Config::DB_NAME,
                'user'     => Config::DB_USER,
                'password' => Config::DB_PASS
            ];

            DbService::$entityManager = EntityManager::create($conn, $config);
        }

        return DbService::$entityManager;
    }
}
