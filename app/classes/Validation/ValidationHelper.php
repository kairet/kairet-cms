<?php
namespace KCMS\Validation;

use KCMS\Services\ServiceLocator;

/**
 * Service class for validation
 * @package KCMS\Validation
 */
class ValidationHelper
{
    /**
     * @param $object
     * @throws ValidationException
     */
    public static function validate($object)
    {
        $errors = ServiceLocator::getValidator()->validate($object);
        if (count($errors) > 0) {
            $errorMsg = 'Validation failed:' . PHP_EOL;
            foreach ($errors as $error) {
                $errorMsg .= $error . PHP_EOL;
            }

            throw new ValidationException('Validation failed:' . PHP_EOL . $errorMsg);
        }
    }
}
