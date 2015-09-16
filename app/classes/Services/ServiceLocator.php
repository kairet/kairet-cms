<?php
namespace KCMS\Services;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use KCMS\Config;
use Monolog\Logger;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class to locate and register services in a static way from any context
 *
 * @package KCMS\Services
 */
class ServiceLocator
{
    /**
     * @var Logger
     */
    private static $monolog;

    /**
     * @var EntityManager
     */
    private static $entityManager;

    /**
     * @var ValidatorInterface
     */
    private static $validator;

    /**
     * @var AuthorizationCheckerInterface
     */
    private static $authChecker;

    /**
     * @param Logger $logger
     */
    public static function registerMonolog(Logger $logger)
    {
        ServiceLocator::$monolog = $logger;
    }

    /**
     * @param ValidatorInterface $validator
     */
    public static function registerValidator(ValidatorInterface $validator)
    {
        ServiceLocator::$validator = $validator;
    }

    public static function registerAuthChecker(AuthorizationCheckerInterface $authChecker)
    {
        ServiceLocator::$authChecker = $authChecker;
    }

    /**
     * @return Logger
     * @throws ServiceNotRegisteredException
     */
    public static function getMonolog()
    {
        return ServiceLocator::checkAndReturn(ServiceLocator::$monolog);
    }

    /**
     * @return EntityManager
     * @throws ServiceNotRegisteredException
     */
    public static function getEntityManager()
    {
        if (ServiceLocator::$entityManager === null) {
            ServiceLocator::$entityManager = EntityManager::create(
                [
                    'driver'   => Config::DB_DRIVER,
                    'host'     => Config::DB_HOST,
                    'dbname'   => Config::DB_NAME,
                    'user'     => Config::DB_USER,
                    'password' => Config::DB_PASS
                ],
                Setup::createAnnotationMetadataConfiguration(
                    [__DIR__ . '/../Models'],
                    Config::DEV_MODE,
                    null,
                    null,
                    false
                )
            );
        }

        return ServiceLocator::checkAndReturn(ServiceLocator::$entityManager);
    }

    /**
     * @return ValidatorInterface
     * @throws ServiceNotRegisteredException
     */
    public static function getValidator()
    {
        return ServiceLocator::checkAndReturn(ServiceLocator::$validator);
    }

    /**
     * @return AuthorizationCheckerInterface
     * @throws ServiceNotRegisteredException
     */
    public static function getAuthChecker()
    {
        return ServiceLocator::checkAndReturn(ServiceLocator::$authChecker);
    }

    /**
     * Returns the referenced variable if it is not null, throws a {@see ServiceNotRegisteredException} otherwise
     *
     * @param $var
     *
     * @return mixed
     * @throws ServiceNotRegisteredException
     */
    private static function checkAndReturn(&$var)
    {
        if ($var === null) {
            throw new ServiceNotRegisteredException();
        }

        return $var;
    }
}
