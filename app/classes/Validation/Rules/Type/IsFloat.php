<?php
namespace KCMS\Validation\Rules\Type;

use KCMS\Validation\Rules\AbstractRule;

class IsFloat extends AbstractRule
{
    /**
     * @param $value
     * @return boolean
     */
    public function check(&$value)
    {
        return is_float($value);
    }

    /**
     * @return string
     */
    public function getFailMessage()
    {
        return "Value needs to be of type 'float'";
    }
}
