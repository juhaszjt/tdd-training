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

    public function testSuccessfulLoginProcess()
    {        
        $captcha = $this->getCaptchaMockObject();
        $counter = $this->getCounterMockObject();
        
        $captcha
            ->expects($this->once())
            ->method('setCaptchaStatus');

        $counter
            ->expects($this->once())
            ->method('resetFailedLoginIpCounter');

        $counter
            ->expects($this->once())
            ->method('resetFailedLoginIpRangeCounter');

        $counter
            ->expects($this->once())
            ->method('resetFailedLoginIpCountryCounter');

        $counter
            ->expects($this->once())
            ->method('resetFailedLoginUsernameCounter');

        $this->login->successfulLogin($captcha, $counter);
    }
    
    public function testShowCaptchaAfterFirstUnSuccessfulLoginFromIp()
    {
        $failedAttempt = 1;

        $counter = $this->getCounterMockObject();

        $counter
            ->expects($this->any())
            ->method('getFailedLoginIpCounter')
            ->will($this->returnValue($failedAttempt));

        $counter
            ->expects($this->any())
            ->method('getFailedLoginIpRangeCounter')
            ->will($this->returnValue($failedAttempt));

        $counter
            ->expects($this->any())
            ->method('getFailedLoginIpCountryCounter')
            ->will($this->returnValue($failedAttempt));
        
        $this->assertFalse($this->login->showCaptchaAfterUnSuccessfulLoginFromIp($counter));
    }

    public function testShowCaptchaAfterThirdUnSuccessfulLoginFromIp()
    {
        $failedAttempt = 3;

        $counter = $this->getCounterMockObject();

        $counter
            ->expects($this->any())
            ->method('getFailedLoginIpCounter')
            ->will($this->returnValue($failedAttempt));

        $counter
            ->expects($this->any())
            ->method('getFailedLoginIpRangeCounter')
            ->will($this->returnValue($failedAttempt));

        $counter
            ->expects($this->any())
            ->method('getFailedLoginIpCountryCounter')
            ->will($this->returnValue($failedAttempt));

        $this->assertTrue($this->login->showCaptchaAfterUnSuccessfulLoginFromIp($counter));
    }

    public function testShowCaptchaAfterFirstUnSuccessfulLoginFromRange()
    {
        $failedAttempt = 1;

        $counter = $this->getCounterMockObject();

        $counter
            ->expects($this->any())
            ->method('getFailedLoginIpRangeCounter')
            ->will($this->returnValue($failedAttempt));

        $this->assertFalse($this->login->showCaptchaAfterUnSuccessfulLoginFromRange($counter));
    }

    public function testShowCaptchaAfterFiveHundredthUnSuccessfulLoginFromRange()
    {
        $failedAttempt = 500;

        $counter = $this->getCounterMockObject();

        $counter
            ->expects($this->any())
            ->method('getFailedLoginIpRangeCounter')
            ->will($this->returnValue($failedAttempt));

        $this->assertTrue($this->login->showCaptchaAfterUnSuccessfulLoginFromRange($counter));
    }

    public function testShowCaptchaAfterFirstUnSuccessfulLoginFromCountry()
    {
        $failedAttempt = 1;

        $counter = $this->getCounterMockObject();

        $counter
            ->expects($this->any())
            ->method('getFailedLoginIpCountryCounter')
            ->will($this->returnValue($failedAttempt));

        $this->assertFalse($this->login->showCaptchaAfterUnSuccessfulLoginFromCountry($counter));
    }

    public function testShowCaptchaAfterOneThousandthUnSuccessfulLoginFromCountry()
    {
        $failedAttempt = 1000;

        $counter = $this->getCounterMockObject();

        $counter
            ->expects($this->any())
            ->method('getFailedLoginIpCountryCounter')
            ->will($this->returnValue($failedAttempt));

        $this->assertTrue($this->login->showCaptchaAfterUnSuccessfulLoginFromCountry($counter));
    }
}
 