<?php
namespace KCMS\Services;

use Exception;

/**
 * Exception class for requesting an unregistered service in {@see ServiceLocator}
 * @package KCMS\Services
 */
class ServiceNotRegisteredException extends \RuntimeException
{
    public function __construct(
        $message = 'Service was accessed but not yet registered',
        $code = 0,
        Exception $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
