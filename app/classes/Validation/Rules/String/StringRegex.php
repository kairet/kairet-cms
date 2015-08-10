<?php
namespace KCMS\Validation\Rules\String;

use KCMS\Validation\Rules\AbstractRule;

class StringRegex extends AbstractRule
{
    /**
     * @var string
     */
    private $regex;

    /**
     * StringRegex constructor.
     * @param string $regex
     */
    public function __construct($regex)
    {
        $this->regex = $regex;
    }

    /**
     * @param $value
     * @return boolean
     */
    public function check(&$value)
    {
        return preg_match($this->regex, $value) === 1;
    }

    /**
     * @return string
     */
    public function getFailMessage()
    {
        return "Value must match the pattern '{$this->regex}'";
    }
}
