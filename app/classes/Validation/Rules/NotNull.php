<?php
namespace KCMS\Validation\Rules;

class NotNull extends AbstractRule
{
    /**
     * @param $value
     * @return boolean
     */
    public function check(&$value)
    {
        return $value !== null;
    }

    /**
     * @return string
     */
    public function getFailMessage()
    {
        return "Value cannot be null";
    }
}
