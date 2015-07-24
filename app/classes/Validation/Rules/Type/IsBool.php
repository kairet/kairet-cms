<?php
namespace KCMS\Validation\Rules\Type;

use KCMS\Validation\Rules\AbstractRule;

class IsBool extends AbstractRule
{
    /**
     * @param $value
     * @return boolean
     */
    public function check(&$value)
    {
        return is_bool($value);
    }

    /**
     * @return string
     */
    public function getFailMessage()
    {
        return "Value needs to be of type 'boolean'";
    }
}
