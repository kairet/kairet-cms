<?php
namespace KCMS\Validation\Rules\Number;

use KCMS\Validation\Rules\AbstractRule;

class NumberRange extends AbstractRule
{
    /**
     * @var float|null
     */
    private $min;

    /**
     * @var float|null
     */
    private $max;

    /**
     * NumberRange constructor.
     * @param float|null $min
     * @param float|null $max
     */
    public function __construct($min = null, $max = null)
    {
        $this->min = $min;
        $this->max = $max;
    }

    /**
     * @param $value
     * @return boolean
     */
    public function check(&$value)
    {
        if ($this->min !== null && $value < $this->min) {
            return false;
        }
        if ($this->max !== null && $value > $this->max) {
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
        if ($this->min > 0) {
            $msg .= "Value must be greater or equal to {$this->min}";
        }
        if ($this->max > 0) {
            if ($msg !== "") {
                $msg .= " and v";
            } else {
                $msg .= "V";
            }
            $msg .= "alue must be less or equal to {$this->max}";
        }

        return $msg;
    }
}
