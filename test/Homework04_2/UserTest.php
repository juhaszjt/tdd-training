<?php

namespace FraudSystem\Test\Homework04_2;

use FraudSystem\Homework04_2\User;

class UserTest extends \PHPUnit_Framework_TestCase
{
    private $user;

    public function setUp()
    {
        $this->user = new User();
    }

    public function tearDown()
    {
        unset($this->user);
    }

    public function testRegistrationCountryVariableExistsAndType()
    {
        $this->assertAttributeInternalType('string', 'registrationCountry', $this->user);
    }

    public function testRegistrationCountryVariableDefaultValue()
    {
        $this->assertEquals('', $this->user->getRegistrationCountry());
    }

    public function testRegistrationCountryReturnValue()
    {
        $registrationCountry = 'UK';
        
        $this->user->setRegistrationCountry($registrationCountry);

        $this->assertEquals($registrationCountry, $this->user->getRegistrationCountry());
    }

    /**
     * @dataProvider invalidRegistrationCountryDataProvider
     * @expectedException \InvalidArgumentException
     */
    public function testRegistrationCountryWithInvalidValueThrowsException($registrationCountry)
    {
        $this->user->setRegistrationCountry($registrationCountry);
    }
    
    public function invalidRegistrationCountryDataProvider()
    {
        return array(
            array(new \stdClass()),
            array('c'),
            array('country'),
            array(false),
            array(null),
            array(array()),
            array(-1)
        );
    }
}
 