<?php
namespace KCMS\Validation\Rules\Type;

use KCMS\Validation\Rules\AbstractRule;

class IsString extends AbstractRule
{
    /**
     * @param $value
     * @return boolean
     */
    public function check(&$value)
    {
        return is_string($value);
    }

    /**
     * @return string
     */
    public function getFailMessage()
    {
        return "Value needs to be of type 'string'";
    }
}
