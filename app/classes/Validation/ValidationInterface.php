<?php
namespace KCMS\Validation;

/**
 * Indicates an object implements validation logic
 *
 * @package KCMS\Validation
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
