<?php
namespace KCMS\Tests;

use KCMS\Validation\RegexBank;
use KCMS\Validation\Rules\Number\NumberNegative;
use KCMS\Validation\Rules\Number\NumberPositive;
use KCMS\Validation\Rules\Number\NumberRange;
use KCMS\Validation\Rules\String\StringLength;
use KCMS\Validation\Rules\String\StringNotEmpty;
use KCMS\Validation\Rules\String\StringRegex;
use KCMS\Validation\Rules\Type\IsBool;
use KCMS\Validation\Rules\Type\IsClass;
use KCMS\Validation\Rules\Type\IsFloat;
use KCMS\Validation\Rules\Type\IsInt;
use KCMS\Validation\Rules\Type\IsString;
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

        // StringRegex
        $mail = "test@test.com";
        $this->assertTrue(ValidationHelper::isValid($mail, [new StringRegex(RegexBank::EMAIL)]));
        $notAMail = "test@@test.com";
        $notAMail2 = "test@com";
        $this->assertFalse(ValidationHelper::isValid($notAMail, [new StringRegex(RegexBank::EMAIL)]));
        $this->assertFalse(ValidationHelper::isValid($notAMail2, [new StringRegex(RegexBank::EMAIL)]));
    }

    public function testTypeValidation()
    {
        // IsBool
        $bool = false;
        $this->assertTrue(ValidationHelper::isValid($bool, [new IsBool()]));
        $bool2 = true;
        $this->assertTrue(ValidationHelper::isValid($bool2, [new IsBool()]));
        $notABool = "value";
        $this->assertFalse(ValidationHelper::isValid($notABool, [new IsBool()]));
        $null = null;
        $this->assertFalse(ValidationHelper::isValid($null, [new IsBool()]));
        $notSet = "value";
        unset($notSet);
        $this->assertFalse(ValidationHelper::isValid($notSet, [new IsBool()]));

        // IsFloat
        $float = 1.0;
        $this->assertTrue(ValidationHelper::isValid($float, [new IsFloat()]));
        $int = 1;
        $this->assertFalse(ValidationHelper::isValid($int, [new IsFloat()]));
        $string = "1.0";
        $this->assertFalse(ValidationHelper::isValid($string, [new IsFloat()]));
        $null = null;
        $this->assertFalse(ValidationHelper::isValid($null, [new IsFloat()]));
        $notSet = "value";
        unset($notSet);
        $this->assertFalse(ValidationHelper::isValid($notSet, [new IsFloat()]));

        // IsInt
        $float = 1.0;
        $this->assertFalse(ValidationHelper::isValid($float, [new IsInt()]));
        $int = 1;
        $this->assertTrue(ValidationHelper::isValid($int, [new IsInt()]));
        $string = "1";
        $this->assertFalse(ValidationHelper::isValid($string, [new IsInt()]));
        $null = null;
        $this->assertFalse(ValidationHelper::isValid($null, [new IsInt()]));
        $notSet = "value";
        unset($notSet);
        $this->assertFalse(ValidationHelper::isValid($notSet, [new IsInt()]));

        // IsString
        $float = 1.0;
        $this->assertFalse(ValidationHelper::isValid($float, [new IsString()]));
        $int = 1;
        $this->assertFalse(ValidationHelper::isValid($int, [new IsString()]));
        $string = "1";
        $this->assertTrue(ValidationHelper::isValid($string, [new IsString()]));
        $null = null;
        $this->assertFalse(ValidationHelper::isValid($null, [new IsString()]));
        $notSet = "value";
        unset($notSet);
        $this->assertFalse(ValidationHelper::isValid($notSet, [new IsString()]));

        // IsClass
        $float = 1.0;
        $this->assertFalse(ValidationHelper::isValid($float, [new IsClass('\DateTime')]));
        $int = 1;
        $this->assertFalse(ValidationHelper::isValid($int, [new IsClass('\DateTime')]));
        $dateTime = new \DateTime();
        $this->assertTrue(ValidationHelper::isValid($dateTime, [new IsClass('\DateTime')]));
        $null = null;
        $this->assertFalse(ValidationHelper::isValid($null, [new IsClass('\DateTime')]));
        $notSet = new \DateTime();
        unset($notSet);
        $this->assertFalse(ValidationHelper::isValid($notSet, [new IsClass('\DateTime')]));
    }

    public function testNumberValidation()
    {
        // NumberNegative
        $num = -1;
        $this->assertTrue(ValidationHelper::isValid($num, [new NumberNegative()]));
        $num2 = -1.00001212;
        $this->assertTrue(ValidationHelper::isValid($num2, [new NumberNegative()]));
        $num3 = 1.00001212;
        $this->assertFalse(ValidationHelper::isValid($num3, [new NumberNegative()]));
        $num4 = 1;
        $this->assertFalse(ValidationHelper::isValid($num4, [new NumberNegative()]));
        $string = "-1";
        $this->assertTrue(ValidationHelper::isValid($string, [new NumberNegative()]));
        $this->assertFalse(ValidationHelper::isValid($string, [new IsInt(), new NumberNegative()]));
        $null = null;
        $this->assertFalse(ValidationHelper::isValid($null, [new NumberNegative()]));
        $notSet = "value";
        unset($notSet);
        $this->assertFalse(ValidationHelper::isValid($notSet, [new NumberNegative()]));

        // NumberPositive
        $num = -1;
        $this->assertFalse(ValidationHelper::isValid($num, [new NumberPositive()]));
        $num2 = -1.00001212;
        $this->assertFalse(ValidationHelper::isValid($num2, [new NumberPositive()]));
        $num3 = 1.00001212;
        $this->assertTrue(ValidationHelper::isValid($num3, [new NumberPositive()]));
        $num4 = 1;
        $this->assertTrue(ValidationHelper::isValid($num4, [new NumberPositive()]));
        $string = "1";
        $this->assertTrue(ValidationHelper::isValid($string, [new NumberPositive()]));
        $this->assertFalse(ValidationHelper::isValid($string, [new IsInt(), new NumberPositive()]));
        $null = null;
        $this->assertTrue(ValidationHelper::isValid($null, [new NumberPositive()]));
        $notSet = "value";
        unset($notSet);
        $this->assertTrue(ValidationHelper::isValid($notSet, [new NumberPositive()]));

        // NumberRange
        $num = 1;
        $this->assertTrue(ValidationHelper::isValid($num, [new NumberRange(0, 2)]));
        $this->assertTrue(ValidationHelper::isValid($num, [new NumberRange(1, 1)]));
        $this->assertTrue(ValidationHelper::isValid($num, [new NumberRange(null, 1)]));
        $this->assertTrue(ValidationHelper::isValid($num, [new NumberRange(1, null)]));
        $this->assertTrue(ValidationHelper::isValid($num, [new NumberRange()]));
        $this->assertFalse(ValidationHelper::isValid($num, [new NumberRange(2, 3)]));
        $this->assertFalse(ValidationHelper::isValid($num, [new NumberRange(null, 0)]));
        $this->assertFalse(ValidationHelper::isValid($num, [new NumberRange(2, null)]));
        $null = null;
        $this->assertFalse(ValidationHelper::isValid($null, [new NumberRange(-1, 1)]));
        $notSet = "value";
        unset($notSet);
        $this->assertFalse(ValidationHelper::isValid($notSet, [new NumberRange(-1, 1)]));
    }
}
