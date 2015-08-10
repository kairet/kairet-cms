<?php
namespace KCMS\Validation\Rules\Value;

use KCMS\Validation\Rules\AbstractRule;

class NotEmpty extends AbstractRule
{
    /**
     * @param $value
     * @return boolean
     */
    public function check(&$value)
    {
        return !empty($value);
    }

    /**
     * @return string
     */
    public function getFailMessage()
    {
        return "Value cannot be empty";
    }
}
