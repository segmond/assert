<?php
namespace Assert\Tests;

use Assert\Assertion;

class AssertTest extends \PHPUnit_Framework_TestCase
{
    static public function dataInvalidInteger()
    {
        return array(
            array(1.23),
            array(false),
            array("test"),
            array(null),
            array("1.23"),
            array("10"),
        );
    }

    /**
     * @dataProvider dataInvalidInteger
     */
    public function testInvalidInteger($nonInteger)
    {
        $this->setExpectedException('Assert\InvalidArgumentException', null, Assertion::INVALID_INTEGER);
        Assertion::integer($nonInteger);
    }

    public function testValidInteger()
    {
        Assertion::integer(10);
        Assertion::integer(0);
    }

    public function testValidIntegerish()
    {
        Assertion::integerish(10);
        Assertion::integerish("10");
    }

    static public function dataInvalidIntegerish()
    {
        return array(
            array(1.23),
            array(false),
            array("test"),
            array(null),
            array("1.23"),
        );

    }

    /**
     * @dataProvider dataInvalidIntegerish
     */
    public function testInvalidIntegerish($nonInteger)
    {
        $this->setExpectedException('Assert\InvalidArgumentException', null, Assertion::INVALID_INTEGERISH);
        Assertion::integerish($nonInteger);
    }

    public function testValidBoolean()
    {
        Assertion::boolean(true);
        Assertion::boolean(false);
    }

    public function testInvalidBoolean()
    {
        $this->setExpectedException('Assert\InvalidArgumentException', null, Assertion::INVALID_BOOLEAN);
        Assertion::boolean(1);
    }

    static public function dataInvalidNotEmpty()
    {
        return array(
            array(""),
            array(false),
            array(0),
            array(null),
            array( array() ),
        );
    }

    /**
     * @dataProvider dataInvalidNotEmpty
     */
    public function testInvalidNotEmpty($value)
    {
        $this->setExpectedException('Assert\InvalidArgumentException', null, Assertion::VALUE_EMPTY);
        Assertion::notEmpty($value);
    }

    public function testNotEmpty()
    {
        Assertion::notEmpty("test");
        Assertion::notEmpty(1);
        Assertion::notEmpty(true);
        Assertion::notEmpty( array("foo") );
    }

    public function testNotNull()
    {
        Assertion::notNull("1");
        Assertion::notNull(1);
        Assertion::notNull(0);
        Assertion::notNull(array());
        Assertion::notNull(false);
    }

    public function testInvalidNotNull()
    {
        $this->setExpectedException('Assert\InvalidArgumentException', null, Assertion::VALUE_NULL);
        Assertion::notNull(null);
    }

    public function testInvalidRegex()
    {
        $this->setExpectedException('Assert\InvalidArgumentException', null, Assertion::INVALID_REGEX);
        Assertion::regex("foo", "(bar)");
    }

    public function testInvalidRegexValueNotString()
    {
        $this->setExpectedException('Assert\InvalidArgumentException', null, Assertion::INVALID_STRING);
        Assertion::regex(array("foo"), "(bar)");
    }

    public function testInvalidMinLength()
    {
        $this->setExpectedException('Assert\InvalidArgumentException', null, Assertion::INVALID_MIN_LENGTH);
        Assertion::minLength("foo", 4);
    }

    public function testInvalidMaxLength()
    {
        $this->setExpectedException('Assert\InvalidArgumentException', null, Assertion::INVALID_MAX_LENGTH);
        Assertion::maxLength("foo", 2);
    }

    public function testInvalidBetweenLengthMin()
    {
        $this->setExpectedException('Assert\InvalidArgumentException', null, Assertion::INVALID_MIN_LENGTH);
        Assertion::betweenLength("foo", 4, 100);
    }

    public function testInvalidBetweenLengthMax()
    {
        $this->setExpectedException('Assert\InvalidArgumentException', null, Assertion::INVALID_MAX_LENGTH);
        Assertion::betweenLength("foo", 0, 2);
    }

    public function testInvalidStartsWith()
    {
        $this->setExpectedException('Assert\InvalidArgumentException', null, Assertion::INVALID_STRING_START);
        Assertion::startsWith("foo", "bar");
    }
}
