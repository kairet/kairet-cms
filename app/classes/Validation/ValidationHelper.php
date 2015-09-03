<?php
namespace KCMS\Validation;

use KCMS\Services\ServiceLocator;

/**
 * Service class for validation
 *
 * @package KCMS\Validation
 */
class ValidationHelper
{
    /**
     * Validates an object using the registered {@see Symfony\Component\Validator\Validator\ValidatorInterface} in
     * {@see ServiceLocator}
     *
     * @param object $object The object to be validated
     *
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
