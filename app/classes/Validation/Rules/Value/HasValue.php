<?php
namespace KCMS\Validation\Rules\Value;

use KCMS\Validation\ValidationHelper;

class HasValue extends AbstractRule
{
    /**
     * @param $value
     * @return boolean
     */
    public function check(&$value)
    {
        return ValidationHelper::isValid($value, [new NotUnset(), new NotNull(), new NotEmpty()]);
    }

    /**
     * @return string
     */
    public function getFailMessage()
    {
        return "Field cannot have no value";
    }
}
