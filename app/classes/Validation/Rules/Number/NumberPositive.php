<?php
namespace KCMS\Validation\Rules\Number;

use KCMS\Validation\Rules\AbstractRule;

class NumberPositive extends AbstractRule
{
    /**
     * @param $value
     * @return boolean
     */
    public function check(&$value)
    {
        return $value >= 0;
    }

    /**
     * @return string
     */
    public function getFailMessage()
    {
        return "Value must be positive";
    }
}
