<?php

namespace Tdd\Test\StringCalculator;

use Tdd\StringCalculator\StringCalculator;

class StringCalculatorTest extends \PHPUnit_Framework_TestCase
{
    private $stringCalculator;

    public function setUp()
    {
        $this->stringCalculator = new StringCalculator();
    }

    public function tearDown()
    {
        unset($this->stringCalculator);
    }
    
    public function testAddMethodWithEmptyString()
    {
        $this->assertEquals(0, $this->stringCalculator->add(''));
    }

    /**
     * @dataProvider addMethodWithValidStringsDataProvider
     *
     * @param array $params
     */
    public function testAddMethodWithValidStrings(array $params)
    {
        list($expected, $actualParam) = $params;
        $this->assertEquals($expected, $this->stringCalculator->add($actualParam));
    }
    
    public function addMethodWithValidStringsDataProvider()
    {
        return array(
            array(
                array(4, '1,3'),
                array(1, '1'),
                array(5, '1,4'),
                array(5, '1,kakao,4'),
                array(15, '1,10,4'),
                array(49, '1,44,4'),
                array(0, 'kes'),
                array(6, '1\n2,3'),
                array(1, '1,1001'),
            )
        );
    }
    
    /**
     * @dataProvider addMethodWithInValidStringsDataProvider
     * @expectedException \InvalidArgumentException
     */
    public function testAddMethodWithInValidStrings($numbers)
    {
        $this->stringCalculator->add($numbers);
    }
    
    public function addMethodWithInValidStringsDataProvider()
    {
        return array(
            array('-1'),
            array('-1,5,-9'),
            array('-1,sas,8'),
        );
    }
    
    /**
     * @dataProvider addMethodWithDifferentDelimiterDataProvider
     *
     * @param array $params
     */
    public function testAddMethodWithDifferentDelimiter(array $params)
    {
        list($expected, $actualParam) = $params;
        $this->assertEquals($expected, $this->stringCalculator->add($actualParam));
    }
    
    public function addMethodWithDifferentDelimiterDataProvider()
    {
        return array(
            array(
                array(3, '//;\n1;2'),
                array(7, '//:::\n5:::2'),
            )
        );
    }
}
 