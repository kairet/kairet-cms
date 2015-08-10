<?php
namespace KCMS\Validation\Rules\Type;

use KCMS\Validation\Rules\AbstractRule;

class IsClass extends AbstractRule
{
    /**
     * @var string
     */
    private $className;

    /**
     * IsClass constructor.
     * @param string $fullyQualifiedClassName
     */
    public function __construct($fullyQualifiedClassName)
    {
        $this->className = $fullyQualifiedClassName;
    }

    /**
     * @param $value
     * @return boolean
     */
    public function check(&$value)
    {
        return is_a($value, $this->className);
    }

    /**
     * @return string
     */
    public function getFailMessage()
    {
        return "Value needs to be of type '{$this->className}'";
    }
}
