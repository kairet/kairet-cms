<?php
namespace KCMS\Validation\Rules\String;

use KCMS\Validation\Rules\AbstractRule;
use KCMS\Validation\ValidationHelper;

class StringNotEmpty extends AbstractRule
{
    /**
     * @param $value
     * @return boolean
     */
    public function check(&$value)
    {
        return ValidationHelper::isValid($value, [new StringLength(1)]);
    }

    /**
     * @return string
     */
    public function getFailMessage()
    {
        return "Value must not be empty";
    }
}
