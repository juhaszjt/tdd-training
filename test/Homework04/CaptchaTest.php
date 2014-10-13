<?php
/**
 * Created by PhpStorm.
 * User: jani
 * Date: 13/10/2014
 * Time: 20:33
 */

namespace FraudSystem\Test\Homework04;

use FraudSystem\Homework04\Captcha;

class CaptchaTest extends \PHPUnit_Framework_TestCase
{
    private $captcha;

    public function setUp()
    {
        $this->captcha = new Captcha();
    }

    public function tearDown()
    {
        unset($this->captcha);
    }

    public function testCaptchaClassExists()
    {
        $this->assertEquals($this->captcha, new Captcha());
    }

    public function testCaptchaStatus()
    {
        $this->assertAttributeInternalType('boolean', 'captchaIsActive', $this->captcha);

        $this->assertEquals(false, $this->captcha->isCaptchaIsActive());
    }

    public function testFailedLoginIp()
    {
        $this->assertEquals(0, $this->captcha->getFailedLoginIp());

        $this->captcha->increaseFailedLoginIp();

        $this->assertEquals(1, $this->captcha->getFailedLoginIp());
    }

    public function testCaptchaStatusAfterFailedLoginIpAttempts()
    {
        $this->assertEquals(false, $this->captcha->isCaptchaIsActive());

        for($attempt = 1; $attempt <= 3; $attempt++)
        {
            $this->captcha->increaseFailedLoginIp();
        }

        $this->assertEquals(true, $this->captcha->isCaptchaIsActive());
    }

    public function testFailedLoginIpRange()
    {
        $this->assertEquals(0, $this->captcha->getFailedLoginIpRange());

        $this->captcha->increaseFailedLoginIpRange();

        $this->assertEquals(1, $this->captcha->getFailedLoginIpRange());
    }

    public function testCaptchaStatusAfterFailedLoginIpRangeAttempts()
    {
        $this->assertEquals(false, $this->captcha->isCaptchaIsActive());

        for($attempt = 1; $attempt <= 500; $attempt++)
        {
            $this->captcha->increaseFailedLoginIpRange();
        }

        $this->assertEquals(true, $this->captcha->isCaptchaIsActive());
    }

    public function testFailedLoginIpCountry()
    {
        $this->assertEquals(0, $this->captcha->getFailedLoginIpCountry());

        for($attempt = 1; $attempt <= 5; $attempt++)
        {
            $this->captcha->increaseFailedLoginIpCountry();
        }

        $this->assertEquals(5, $this->captcha->getFailedLoginIpCountry());
    }

    public function testCaptchaStatusAfterFailedLoginIpCountryAttempts()
    {
        $this->assertEquals(false, $this->captcha->isCaptchaIsActive());

        for($attempt = 1; $attempt <= 1000; $attempt++)
        {
            $this->captcha->increaseFailedLoginIpCountry();
        }

        $this->assertEquals(true, $this->captcha->isCaptchaIsActive());
    }

    public function testFailedLoginUsername()
    {
        $this->assertEquals(0, $this->captcha->getFailedLoginUsername());

        for($attempt = 1; $attempt <= 2; $attempt++)
        {
            $this->captcha->increaseFailedLoginUsername();
        }

        $this->assertEquals(2, $this->captcha->getFailedLoginUsername());
    }

    public function testCaptchaStatusAfterFailedLoginUsernameAttempts()
    {
        $this->assertEquals(false, $this->captcha->isCaptchaIsActive());

        for($attempt = 1; $attempt <= 3; $attempt++)
        {
            $this->captcha->increaseFailedLoginUsername();
        }

        $this->assertEquals(true, $this->captcha->isCaptchaIsActive());
    }

    public function testFailedLoginIpIncreaseIpIpRangeCountry()
    {
        $this->captcha->increaseFailedLoginIp();

        $this->assertEquals(1, $this->captcha->getFailedLoginIp());
        $this->assertEquals(1, $this->captcha->getFailedLoginIpRange());
        $this->assertEquals(1, $this->captcha->getFailedLoginIpCountry());
    }

    public function testFailedLoginIpIncreaseIpIpRangeCountryAfterCaptchaActivated()
    {
        for($attempt = 1; $attempt <= 5; $attempt++)
        {
            $this->captcha->increaseFailedLoginIp();
        }

        $this->assertEquals(5, $this->captcha->getFailedLoginIp());
        $this->assertEquals(3, $this->captcha->getFailedLoginIpRange());
        $this->assertEquals(3, $this->captcha->getFailedLoginIpCountry());

        return $this->captcha;
    }

    public function testFailedLoginWithDifferentRegistrationAndActualCountry()
    {
        $this->assertEquals(false, $this->captcha->isCaptchaIsActive());

        $registrationCountry = 'LU';
        $actualCountry       = 'LU';

        $this->captcha->checkRegistrationAndActualCountryAfterFailedLogin($registrationCountry, $actualCountry);

        $this->assertEquals(false, $this->captcha->isCaptchaIsActive());

        $registrationCountry = 'LU';
        $actualCountry       = 'DE';

        $this->captcha->checkRegistrationAndActualCountryAfterFailedLogin($registrationCountry, $actualCountry);

        $this->assertEquals(true, $this->captcha->isCaptchaIsActive());
    }

    /**
     * @depends testFailedLoginIpIncreaseIpIpRangeCountryAfterCaptchaActivated
     *
     * @param Captcha $captcha
     */
    public function testResetCountersAfterSuccessfulLogin(Captcha $captcha)
    {
        $loginIp        = $captcha->getFailedLoginIp();
        $loginIpRange   = $captcha->getFailedLoginIpRange();
        $loginIpCountry = $captcha->getFailedLoginIpCountry();

        $captcha->successfulLogin();

        $this->assertNotEquals($loginIp,        $captcha->getFailedLoginIp());
        $this->assertNotEquals($loginIpRange,   $captcha->getFailedLoginIpRange());
        $this->assertNotEquals($loginIpCountry, $captcha->getFailedLoginIpCountry());
    }
}
 