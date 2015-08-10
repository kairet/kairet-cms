<?php
namespace KCMS\Validation\Rules;

/**
 * Base class for validation rules
 * @package KCMS\Validation\Rules
 */
abstract class AbstractRule
{
    /**
     * @param $value
     * @return boolean
     */
    abstract public function check(&$value);

    /**
     * @return string
     */
    abstract public function getFailMessage();
}
