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
        return $this->getMock(
            'FraudSystem\\Homework04_2\\Captcha', 
            array(
                'resetCaptcha',
                'isCaptchaIsActive',
                'setCaptchaToActive',
            )
        );
    }

    public function getCounterMockObject()
    {
        return $this->getMock(
            'FraudSystem\\Homework04_2\\Counter', 
            array(
                'resetFailedLoginIpCounter', 
                'resetFailedLoginIpRangeCounter', 
                'resetFailedLoginIpCountryCounter', 
                'resetFailedLoginUsernameCounter',
                'getFailedLoginIpCounter',                
                'getFailedLoginIpRangeCounter',                
                'getFailedLoginIpCountryCounter',                
            )
        );
    }

    public function testSuccessfulLoginProcess()
    {        
        $captcha = $this->getCaptchaMockObject();
        $counter = $this->getCounterMockObject();
        
        $this->assertTrue($this->login->successfulLogin($captcha, $counter));
    }
    
    public function testShowCaptchaAfterFirstUnSuccessfulLoginFromIp()
    {
        $counterStub = $this->getCounterMockObject();
        
        $counterStub->expects($this->any())->method('getFailedLoginIpCounter')->will($this->returnValue(1));
        $counterStub->expects($this->any())->method('getFailedLoginIpRangeCounter')->will($this->returnValue(1));
        $counterStub->expects($this->any())->method('getFailedLoginIpCountryCounter')->will($this->returnValue(1));
        
        $this->assertFalse($this->login->showCaptchaAfterUnSuccessfulLoginFromIp($counterStub));
    }

    public function testShowCaptchaAfterThirdUnSuccessfulLoginFromIp()
    {
        $counterStub = $this->getCounterMockObject();

        $counterStub->expects($this->any())->method('getFailedLoginIpCounter')->will($this->returnValue(3));
        $counterStub->expects($this->any())->method('getFailedLoginIpRangeCounter')->will($this->returnValue(3));
        $counterStub->expects($this->any())->method('getFailedLoginIpCountryCounter')->will($this->returnValue(3));

        $this->assertTrue($this->login->showCaptchaAfterUnSuccessfulLoginFromIp($counterStub));
    }

    public function testShowCaptchaAfterFirstUnSuccessfulLoginFromRange()
    {
        $counterStub = $this->getCounterMockObject();

        $counterStub->expects($this->any())->method('getFailedLoginIpRangeCounter')->will($this->returnValue(1));

        $this->assertFalse($this->login->showCaptchaAfterUnSuccessfulLoginFromRange($counterStub));
    }

    public function testShowCaptchaAfterFiveHundredthUnSuccessfulLoginFromRange()
    {
        $counterStub = $this->getCounterMockObject();

        $counterStub->expects($this->any())->method('getFailedLoginIpRangeCounter')->will($this->returnValue(500));

        $this->assertTrue($this->login->showCaptchaAfterUnSuccessfulLoginFromRange($counterStub));
    }

    public function testShowCaptchaAfterFirstUnSuccessfulLoginFromCountry()
    {
        $counterStub = $this->getCounterMockObject();

        $counterStub->expects($this->any())->method('getFailedLoginIpCountryCounter')->will($this->returnValue(1));

        $this->assertFalse($this->login->showCaptchaAfterUnSuccessfulLoginFromCountry($counterStub));
    }

    public function testShowCaptchaAfterOneThousandthUnSuccessfulLoginFromCountry()
    {
        $counterStub = $this->getCounterMockObject();

        $counterStub->expects($this->any())->method('getFailedLoginIpCountryCounter')->will($this->returnValue(1000));

        $this->assertTrue($this->login->showCaptchaAfterUnSuccessfulLoginFromCountry($counterStub));
    }
}
 