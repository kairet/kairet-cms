<?php
namespace KCMS\Validation\Rules\String;

use KCMS\Validation\Rules\AbstractRule;

class StringLength extends AbstractRule
{
    /**
     * @var int
     */
    private $minLength;

    /**
     * @var int
     */
    private $maxLength;

    /**
     * StringLength constructor.
     * @param int $minLength
     * @param int $maxLength
     */
    public function __construct($minLength = 0, $maxLength = 0)
    {
        $this->minLength = $minLength;
        $this->maxLength = $maxLength;
    }

    /**
     * @param $value
     * @return boolean
     */
    public function check(&$value)
    {
        $length = strlen($value);

        if ($this->minLength > 0 && $length < $this->minLength) {
            return false;
        }
        if ($this->maxLength > 0 && $length > $this->maxLength) {
            return false;
        }

        return true;
    }

    /**
     * @return string
     */
    public function getFailMessage()
    {
        $msg = "";
        if ($this->minLength > 0) {
            $msg .= "Value needs to have more or equal to {$this->minLength} characters";
        }
        if ($this->maxLength > 0) {
            if ($msg !== "") {
                $msg .= " and v";
            } else {
                $msg .= "V";
            }
            $msg .= "alue needs to have less or equal to {$this->maxLength} characters";
        }

        return $msg;
    }
}
