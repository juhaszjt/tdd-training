<?php

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

    public function getUserMockObject()
    {
        return $this
            ->getMockBuilder('FraudSystem\\Homework04_2\\User')
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
    
    public function testCheckCaptchaAfterFirstUnSuccessfulLoginFromIp()
    {
        $failedAttempt = 1;

        $captcha = $this->getCaptchaMockObject();
        $counter = $this->getCounterMockObject();

        $captcha
            ->expects($this->once())
            ->method('getCaptchaStatus')
            ->will($this->returnValue(false));
            
        $counter
            ->expects($this->exactly(2))
            ->method('getFailedLoginIpCounter')
            ->will($this->returnValue($failedAttempt));

        $counter
            ->expects($this->once())
            ->method('getFailedLoginIpRangeCounter')
            ->will($this->returnValue($failedAttempt));

        $counter
            ->expects($this->once())
            ->method('getFailedLoginIpCountryCounter')
            ->will($this->returnValue($failedAttempt));
        
        $this->assertFalse($this->login->CheckCaptchaAfterUnSuccessfulLoginFromIp($captcha, $counter));
        
        return $failedAttempt;
    }

    public function testCheckCaptchaAfterThirdUnSuccessfulLoginFromIp()
    {
        $failedAttempt = 3;

        $captcha = $this->getCaptchaMockObject();
        $counter = $this->getCounterMockObject();

        $captcha
            ->expects($this->once())
            ->method('setCaptchaStatus');
            
        $captcha
            ->expects($this->once())
            ->method('getCaptchaStatus')
            ->will($this->returnValue(true));

        $counter
            ->expects($this->exactly(2))
            ->method('getFailedLoginIpCounter')
            ->will($this->returnValue($failedAttempt));

        $this->assertTrue($this->login->CheckCaptchaAfterUnSuccessfulLoginFromIp($captcha, $counter));
    }
    
    /**
     * @depends testCheckCaptchaAfterFirstUnSuccessfulLoginFromIp
     */
    public function testCheckCaptchaAfterFirstUnSuccessfulLoginFromIpButFiveHundredthUnSuccessfulLoginFromRange($failedAttemptIp)
    {
        $failedAttemptIpRange = 500;

        $captcha = $this->getCaptchaMockObject();
        $counter = $this->getCounterMockObject();

        $captcha
            ->expects($this->once())
            ->method('setCaptchaStatus');
            
        $captcha
            ->expects($this->once())
            ->method('getCaptchaStatus')
            ->will($this->returnValue(true));

        $counter
            ->expects($this->exactly(2))
            ->method('getFailedLoginIpCounter')
            ->will($this->returnValue($failedAttemptIp));

        $counter
            ->expects($this->once())
            ->method('getFailedLoginIpRangeCounter')
            ->will($this->returnValue($failedAttemptIpRange));
        
        $this->assertTrue($this->login->CheckCaptchaAfterUnSuccessfulLoginFromIp($captcha, $counter));
    }

    /**
     * @depends testCheckCaptchaAfterFirstUnSuccessfulLoginFromIp
     */
    public function testCheckCaptchaAfterFirstUnSuccessfulLoginFromIpAndRangeButOneThousandthUnSuccessfulLoginFromCountry($failedAttemptIp)
    {
        $failedAttemptIpRange   = 1;
        $failedAttemptIpCountry = 1000;

        $captcha = $this->getCaptchaMockObject();
        $counter = $this->getCounterMockObject();

        $captcha
            ->expects($this->once())
            ->method('setCaptchaStatus');
            
        $captcha
            ->expects($this->once())
            ->method('getCaptchaStatus')
            ->will($this->returnValue(true));

        $counter
            ->expects($this->exactly(2))
            ->method('getFailedLoginIpCounter')
            ->will($this->returnValue($failedAttemptIp));

        $counter
            ->expects($this->once())
            ->method('getFailedLoginIpRangeCounter')
            ->will($this->returnValue($failedAttemptIpRange));
            
        $counter
            ->expects($this->once())
            ->method('getFailedLoginIpCountryCounter')
            ->will($this->returnValue($failedAttemptIpCountry));
        
        $this->assertTrue($this->login->CheckCaptchaAfterUnSuccessfulLoginFromIp($captcha, $counter));
    }
    
    public function testCheckCaptchaAfterFirstUnSuccessfulLoginFromRange()
    {
        $failedAttempt = 1;

        $captcha = $this->getCaptchaMockObject();
        $counter = $this->getCounterMockObject();
            
        $captcha
            ->expects($this->once())
            ->method('getCaptchaStatus')
            ->will($this->returnValue(false));

        $counter
            ->expects($this->once())
            ->method('getFailedLoginIpRangeCounter')
            ->will($this->returnValue($failedAttempt));

        $this->assertFalse($this->login->CheckCaptchaAfterUnSuccessfulLoginFromRange($captcha, $counter));
    }

    public function testCheckCaptchaAfterFiveHundredthUnSuccessfulLoginFromRange()
    {
        $failedAttempt = 500;

        $captcha = $this->getCaptchaMockObject();
        $counter = $this->getCounterMockObject();

        $captcha
            ->expects($this->once())
            ->method('setCaptchaStatus');
            
        $captcha
            ->expects($this->once())
            ->method('getCaptchaStatus')
            ->will($this->returnValue(true));

        $counter
            ->expects($this->once())
            ->method('getFailedLoginIpRangeCounter')
            ->will($this->returnValue($failedAttempt));

        $this->assertTrue($this->login->CheckCaptchaAfterUnSuccessfulLoginFromRange($captcha, $counter));
    }

    public function testCheckCaptchaAfterFirstUnSuccessfulLoginFromCountry()
    {
        $failedAttempt = 1;

        $captcha = $this->getCaptchaMockObject();
        $counter = $this->getCounterMockObject();
            
        $captcha
            ->expects($this->once())
            ->method('getCaptchaStatus')
            ->will($this->returnValue(false));

        $counter
            ->expects($this->once())
            ->method('getFailedLoginIpCountryCounter')
            ->will($this->returnValue($failedAttempt));

        $this->assertFalse($this->login->CheckCaptchaAfterUnSuccessfulLoginFromCountry($captcha, $counter));
    }

    public function testCheckCaptchaAfterOneThousandthUnSuccessfulLoginFromCountry()
    {
        $failedAttempt = 1000;

        $captcha = $this->getCaptchaMockObject();
        $counter = $this->getCounterMockObject();

        $captcha
            ->expects($this->once())
            ->method('setCaptchaStatus');
            
        $captcha
            ->expects($this->once())
            ->method('getCaptchaStatus')
            ->will($this->returnValue(true));

        $counter
            ->expects($this->once())
            ->method('getFailedLoginIpCountryCounter')
            ->will($this->returnValue($failedAttempt));

        $this->assertTrue($this->login->CheckCaptchaAfterUnSuccessfulLoginFromCountry($captcha, $counter));
    }
    
    public function testCheckCaptchaAfterFirstUnSuccessfulUsernameLogin()
    {
        $failedAttempt = 1;

        $captcha = $this->getCaptchaMockObject();
        $counter = $this->getCounterMockObject();

        $captcha
            ->expects($this->once())
            ->method('getCaptchaStatus')
            ->will($this->returnValue(false));

        $counter
            ->expects($this->once())
            ->method('getFailedLoginUsernameCounter')
            ->will($this->returnValue($failedAttempt));

        $this->assertFalse($this->login->CheckCaptchaAfterUnSuccessfulUsernameLogin($captcha, $counter));
    }

    public function testCheckCaptchaAfterThirdUnSuccessfulUsernameLogin()
    {
        $failedAttempt = 3;

        $captcha = $this->getCaptchaMockObject();
        $counter = $this->getCounterMockObject();

        $captcha
            ->expects($this->once())
            ->method('setCaptchaStatus');
            
        $captcha
            ->expects($this->once())
            ->method('getCaptchaStatus')
            ->will($this->returnValue(true));

        $counter
            ->expects($this->once())
            ->method('getFailedLoginUsernameCounter')
            ->will($this->returnValue($failedAttempt));

        $this->assertTrue($this->login->CheckCaptchaAfterUnSuccessfulUsernameLogin($captcha, $counter));
    }
    
    public function testCheckCaptchaAfterUnSuccessfulLoginWithDifferentCountries()
    {
        $registrationCountry = 'UK';
        $loginCountry = 'LU';
        
        $user = $this->getUserMockObject();        
        $captcha = $this->getCaptchaMockObject();

        $captcha
            ->expects($this->once())
            ->method('setCaptchaStatus');
            
        $captcha
            ->expects($this->once())
            ->method('getCaptchaStatus')
            ->will($this->returnValue(true));
        
        $user
            ->expects($this->once())
            ->method('getRegistrationCountry')
            ->will($this->returnValue($registrationCountry));
            
        $this->assertTrue($this->login->checkRegistrationAndActualCountryAfterFailedLogin($captcha, $user, $loginCountry));
    }
}
 