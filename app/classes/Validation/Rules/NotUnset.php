<?php
namespace KCMS\Validation\Rules;

class NotUnset extends AbstractRule
{
    /**
     * @param $value
     * @return boolean
     */
    public function check(&$value)
    {
        return isset($value);
    }

    /**
     * @return string
     */
    public function getFailMessage()
    {
        return "Value cannot be not set";
    }
}
