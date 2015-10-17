<?php
namespace AppBundle\Validation;

/**
 * Exception for validation errors in {@see ValidationHelper}
 *
 * @package AppBundle\Validation
 */
class ValidationException extends \Exception
{
    public function __construct($message = '', $code = 400, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
