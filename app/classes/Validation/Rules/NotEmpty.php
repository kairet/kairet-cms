<?php
namespace KCMS\Validation\Rules;

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
