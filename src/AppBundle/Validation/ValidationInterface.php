<?php
namespace AppBundle\Validation;

/**
 * Indicates an object implements validation logic
 *
 * @package AppBundle\Validation
 */
interface ValidationInterface
{
    /**
     * Validate an object, throw {@see ValidationException} if invalid
     *
     * @throws ValidationException
     */
    public function validate();
}
