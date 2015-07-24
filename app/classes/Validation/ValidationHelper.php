<?php
namespace KCMS\Validation;

use KCMS\Validation\Rules\AbstractRule;

/**
 * Service class for validation using {@see AbstractRule}
 * @package KCMS\Validation
 */
class ValidationHelper
{
    /**
     * Validate value using rules and retrieve boolean
     * @param                $value
     * @param AbstractRule[] $rules
     * @param                $name
     * @param                $outMessage
     * @return bool
     */
    public static function isValid(&$value, array $rules, $name = "unknown field", &$outMessage = "no message")
    {
        try {
            ValidationHelper::validate($value, $rules, $name);
        } catch (ValidationException $e) {
            if ($outMessage !== "no message") {
                $outMessage = $e->getMessage();
            }

            return false;
        }

        return true;
    }

    /**
     * Validate value using rules and retrieve exception if invalid
     * @param                $value
     * @param AbstractRule[] $rules
     * @param                $name
     * @throws ValidationException
     */
    public static function validate(&$value, array $rules, $name = "unknown field")
    {
        foreach ($rules as $rule) {
            if (!$rule->check($value)) {
                throw new ValidationException("Validation failed for '{$name}': {$rule->getFailMessage()}");
            }
        }
    }
}
