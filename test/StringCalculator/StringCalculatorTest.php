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
    
    public function testAddMethodExists()
    {
        $testStringCalculator = new StringCalculator();
        
        $this->assertEquals($this->stringCalculator->add(0), $testStringCalculator->add(0));
    }
    
    public function testAddMethodWithEmptyString()
    {
        $testStringCalculator = new StringCalculator();

        $this->assertEquals(0, $testStringCalculator->add(0));
    }

    /**
     * @dataProvider addMethodWithValidStringsDataProvider
     */
    public function testAddMethodWithValidStrings(array $params)
    {
        $testStringCalculator = new StringCalculator();

        $this->assertEquals($params[0], $testStringCalculator->add($params[1]));
    }
    
    public function addMethodWithValidStringsDataProvider()
    {
        return array(
            array(
                array(1, '1'),
                array(3, '1,2'),
                array(5, '1,4'),
                array(12, '1,4,7'),
            )
        );
    }
    
    /**
     * @dataProvider addMethodWithInValidStringsDataProvider
     * @expectedException \InvalidArgumentException
     */
    public function testAddMethodWithInValidStrings(array $params)
    {
        $testStringCalculator = new StringCalculator();

        $this->assertEquals($params[0], $testStringCalculator->add($params[0]));
    }
    
    public function addMethodWithInValidStringsDataProvider()
    {
        return array(
            array(
                array('kakao'),
                array('1,null'),
            )
        );
    }
}
 