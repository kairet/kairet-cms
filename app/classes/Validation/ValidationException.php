<?php
namespace KCMS\Validation;

use Exception;

/**
 * Exception for validation errors in {@see ValidationHelper}
 *
 * @package KCMS\Exceptions
 */
class ValidationException extends \Exception
{
    public function __construct($message = '', $code = 400, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
