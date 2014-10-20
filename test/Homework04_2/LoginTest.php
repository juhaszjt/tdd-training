<?php
/**
 * Created by PhpStorm.
 * User: jani
 * Date: 20/10/2014
 * Time: 22:03
 */

namespace FraudSystem\Test\Homework04_2;

use FraudSystem\Homework04_2\Login;

class LoginTest extends \PHPUnit_Framework_TestCase
{
    private $login;

    public function setUp()
    {
        $this->login = new Login();
    }

    public function tearDown()
    {
        unset($this->login);
    }

    public function testLoginClassExists()
    {
        $this->assertEquals(new Login(), $this->login);
    }

    public function createCaptchaMockObject()
    {
        return $this->getMock(
            'FraudSystem\\Homework04_2\\Captcha', // The class name to use as the base.
            array(), // We don't need any of the original methods.
            array(), // No need for arguments too.
            '', // No custom name for the class.
            false // Don't call the original construct.
        );
    }

    public function createCounterMockObject()
    {
        return $this->getMock(
            'FraudSystem\\Homework04_2\\Counter', array(), array(), '', false
        );
    }

    public function testFailedLoginProcess()
    {
        $counter = $this->createCounterMockObject();
        $captcha = $this->createCaptchaMockObject();
        $errorCode = 3;

        $this->login->failedLogin($counter, $captcha, $errorCode);
    }
}
 