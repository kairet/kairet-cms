<?php
namespace KCMS\Validation\Rules\Type;

use KCMS\Validation\Rules\AbstractRule;

class IsInt extends AbstractRule
{
    /**
     * @param $value
     * @return boolean
     */
    public function check(&$value)
    {
        return is_int($value);
    }

    /**
     * @return string
     */
    public function getFailMessage()
    {
        return "Value needs to be of type 'integer'";
    }
}
