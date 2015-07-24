<?php
namespace KCMS\Tests;

use KCMS\Validation\Rules\String\StringLength;
use KCMS\Validation\Rules\String\StringNotEmpty;
use KCMS\Validation\Rules\Value\HasValue;
use KCMS\Validation\Rules\Value\NotEmpty;
use KCMS\Validation\Rules\Value\NotNull;
use KCMS\Validation\Rules\Value\NotUnset;
use KCMS\Validation\ValidationHelper;

class ValidationTest extends \PHPUnit_Framework_TestCase
{
    public function testValueValidation()
    {
        // NotNull
        $nullValue = null;
        $this->assertFalse(ValidationHelper::isValid($nullValue, [new NotNull()]));
        $notNullValue = "value";
        $this->assertTrue(ValidationHelper::isValid($notNullValue, [new NotNull()]));

        // NotUnset
        $unsetValue = "test";
        unset($unsetValue);
        $this->assertFalse(ValidationHelper::isValid($unsetValue, [new NotUnset()]));
        $notUnsetValue = "test";
        $this->assertTrue(ValidationHelper::isValid($notUnsetValue, [new NotUnset()]));

        // NotEmpty
        $emptyVar = false;
        $this->assertFalse(ValidationHelper::isValid($emptyVar, [new NotEmpty()]));
        $notEmptyVar = "value";
        $this->assertTrue(ValidationHelper::isValid($notEmptyVar, [new NotEmpty()]));

        // HasValue
        $this->assertFalse(ValidationHelper::isValid($nullValue, [new HasValue()]));
        $this->assertFalse(ValidationHelper::isValid($unsetValue, [new HasValue()]));
        $this->assertFalse(ValidationHelper::isValid($emptyVar, [new HasValue()]));
        $this->assertTrue(ValidationHelper::isValid($notNullValue, [new HasValue()]));
        $this->assertTrue(ValidationHelper::isValid($notUnsetValue, [new HasValue()]));
        $this->assertTrue(ValidationHelper::isValid($notEmptyVar, [new HasValue()]));
    }

    public function testStringValidation()
    {
        // StringNotEmpty
        $emptyString = "";
        $this->assertFalse(ValidationHelper::isValid($emptyString, [new StringNotEmpty()]));
        $notEmptyString = "value";
        $this->assertTrue(ValidationHelper::isValid($notEmptyString, [new StringNotEmpty()]));

        // StringLength
        $testString = "12345";
        $this->assertTrue(ValidationHelper::isValid($testString, [new StringLength(0, 0)]));
        $this->assertTrue(ValidationHelper::isValid($testString, [new StringLength(1, 0)]));
        $this->assertTrue(ValidationHelper::isValid($testString, [new StringLength(0, 10)]));
        $this->assertTrue(ValidationHelper::isValid($testString, [new StringLength(0, 5)]));
        $this->assertTrue(ValidationHelper::isValid($testString, [new StringLength(5, 5)]));
        $this->assertTrue(ValidationHelper::isValid($testString, [new StringLength(2, 7)]));
        $this->assertTrue(ValidationHelper::isValid($testString, [new StringLength(-1, -1)]));
        $this->assertTrue(ValidationHelper::isValid($testString, [new StringLength()]));
        $this->assertFalse(ValidationHelper::isValid($testString, [new StringLength(6)]));
        $this->assertFalse(ValidationHelper::isValid($testString, [new StringLength(0, 4)]));
        $this->assertFalse(ValidationHelper::isValid($testString, [new StringLength(10, 4)]));
    }
}
