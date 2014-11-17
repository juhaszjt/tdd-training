<?php

namespace FraudSystem\Test\Homework04_2;

use FraudSystem\Homework04_2\LoginAuth;

class LoginAuthTest extends \PHPUnit_Framework_TestCase
{
    private $loginAuth;
    private $captcha;
    private $counter;
    private $user;
    private $login;
    private $loginAttempt;

    public function setUp()
    {
        $this->loginAuth = new LoginAuth();

        $this->captcha      = $this->getCaptchaMockObject();
        $this->counter      = $this->getCounterMockObject();
        $this->user         = $this->getUserMockObject();
        $this->login        = $this->getLoginMockObject();
        $this->loginAttempt = $this->getLoginAttemptMockObject();
    }

    public function tearDown()
    {
        unset($this->loginAuth);
    }

    public function getCaptchaMockObject()
    {
        return $this
            ->getMockBuilder('FraudSystem\\Homework04_2\\Captcha')
            ->setMethods(array())
            ->getMock();
    }

    public function getCounterMockObject()
    {
        return $this
            ->getMockBuilder('FraudSystem\\Homework04_2\\Counter')
            ->setMethods(array())
            ->getMock();
    }

    public function getUserMockObject()
    {
        return $this
            ->getMockBuilder('FraudSystem\\Homework04_2\\User')
            ->setMethods(array())
            ->getMock();
    }

    public function getLoginMockObject()
    {
        return $this
            ->getMockBuilder('FraudSystem\\Homework04_2\\Login')
            ->setMethods(array())
            ->getMock();
    }

    public function getLoginAttemptMockObject()
    {
        return $this
            ->getMockBuilder('FraudSystem\\Homework04_2\\LoginAttempt')
            ->setMethods(array())
            ->getMock();
    }

    public function testAuthenticationWithSuccessfulLogin()
    {
        $this->loginAttempt
            ->expects($this->once())
            ->method('getErrorCode')
            ->will($this->returnValue(0));

        $this->login
            ->expects($this->once())
            ->method('successfulLogin');

        $this->loginAuth->authenticateProcess($this->user, $this->counter, $this->captcha, $this->login, $this->loginAttempt);
    }

    public function testAuthenticationWithDifferentRegistrationAndActualCountryLogin()
    {
        $this->loginAttempt
            ->expects($this->once())
            ->method('getErrorCode')
            ->will($this->returnValue(1));

        $this->login
            ->expects($this->once())
            ->method('checkRegistrationAndActualCountryAfterFailedLogin')
            ->will($this->returnValue(true));

        $this->loginAuth->authenticateProcess($this->user, $this->counter, $this->captcha, $this->login, $this->loginAttempt);
    }

    /**
     * @dataProvider differentUnSuccessfulLoginDataProvider
     */
    public function testAuthenticationWithUnSuccessfulLogin($errorCode, $loginMethod)
    {
        $this->loginAttempt
            ->expects($this->once())
            ->method('getErrorCode')
            ->will($this->returnValue($errorCode));

        $this->login
            ->expects($this->once())
            ->method('checkRegistrationAndActualCountryAfterFailedLogin')
            ->will($this->returnValue(false));

        $this->login
            ->expects($this->once())
            ->method($loginMethod)
            ->will($this->returnValue(true));

        $this->loginAuth->authenticateProcess($this->user, $this->counter, $this->captcha, $this->login, $this->loginAttempt);
    }

    public function differentUnSuccessfulLoginDataProvider()
    {
        return array(
            array(1, 'checkCaptchaAfterUnSuccessfulLoginFromIp'),
            array(2, 'checkCaptchaAfterUnSuccessfulLoginFromRange'),
            array(3, 'checkCaptchaAfterUnSuccessfulLoginFromCountry'),
            array(4, 'checkCaptchaAfterUnSuccessfulUsernameLogin'),
        );
    }

    /**
     * @expectedException \InvalidArgumentException
     * @dataProvider invalidErrorCodeDataProvider
     */
    public function testAuthenticationWithInvalidErrorCode($errorCode)
    {
        $this->loginAttempt
            ->expects($this->once())
            ->method('getErrorCode')
            ->will($this->returnValue($errorCode));

        $this->login
            ->expects($this->once())
            ->method('checkRegistrationAndActualCountryAfterFailedLogin')
            ->will($this->returnValue(false));

        $this->loginAuth->authenticateProcess($this->user, $this->counter, $this->captcha, $this->login, $this->loginAttempt);
    }

    public function invalidErrorCodeDataProvider()
    {
        return array(
            array(11),
            array('captcha'),
            array(false),
            array(null),
            array(array()),
            array(-1)
        );
    }
}
 