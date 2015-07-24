<?php
namespace KCMS\Validation;

/**
 * Interface for objects that provide validation logic
 * @package KCMS\Validation
 */
interface ValidationInterface
{
    /**
     * @throws ValidationException
     * @return void
     */
    public function validate();
}
