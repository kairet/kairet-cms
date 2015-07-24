<?php
namespace KCMS\Validation;

/**
 * Generic exception for validation errors
 * @package KCMS\Validation
 */
class ValidationException extends \Exception
{
    /**
     * ValidationException constructor.
     * @param string     $message
     * @param int        $code
     * @param \Exception $previous
     */
    public function __construct($message = "A validation error occurred", $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
