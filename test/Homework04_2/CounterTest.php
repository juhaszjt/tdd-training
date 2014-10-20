<?php
/**
 * Created by PhpStorm.
 * User: jani
 * Date: 19/10/2014
 * Time: 23:01
 */

namespace FraudSystem\Test\Homework04_2;

//use FraudSystem\Homework04_2\Captcha;
use FraudSystem\Homework04_2\Counter;

class CounterTest extends \PHPUnit_Framework_TestCase
{
    private $counter;

    public function setUp()
    {
        $this->counter = new Counter();
    }

    public function tearDown()
    {
        unset($this->counter);
    }

    public function testCounterClassExists()
    {
        $this->assertEquals(new Counter(), $this->counter);
    }

    public function testFailedLoginIpAttemptsConstantValue()
    {
        $this->assertEquals(3, Counter::CAPTCHA_STATUS_SWITCH_FAILED_LOGIN_IP_ATTEMPTS);
    }

    public function testFailedLoginIpRangeAttemptsConstantValue()
    {
        $this->assertEquals(500, Counter::CAPTCHA_STATUS_SWITCH_FAILED_LOGIN_IP_RANGE_ATTEMPTS);
    }

    public function testFailedLoginIpCountryAttemptsConstantValue()
    {
        $this->assertEquals(1000, Counter::CAPTCHA_STATUS_SWITCH_FAILED_LOGIN_IP_COUNTRY_ATTEMPTS);
    }

    public function testFailedLoginUsernameAttemptsConstantValue()
    {
        $this->assertEquals(3, Counter::CAPTCHA_STATUS_SWITCH_FAILED_LOGIN_USERNAME_ATTEMPTS);
    }

    public function testFailedLoginIpCounterDefaultValue()
    {
        $this->assertEquals(0, $this->counter->getFailedLoginIpCounter());
    }

    public function testFailedLoginIpCounterIncreaseValue()
    {
        $this->counter->increaseFailedLoginIpCounter();
        $this->assertEquals(1, $this->counter->getFailedLoginIpCounter());
    }

    public function testFailedLoginIpRangeCounterDefaultValue()
    {
        $this->assertEquals(0, $this->counter->getFailedLoginIpRangeCounter());
    }

    public function testFailedLoginIpRangeCounterIncreaseValue()
    {
        $failedAttempts = 5;

        for ($i = 1; $i <= $failedAttempts; $i++)
        {
            $this->counter->increaseFailedLoginIpRangeCounter();
        }

        $this->assertEquals($failedAttempts, $this->counter->getFailedLoginIpRangeCounter());
    }

    public function testFailedLoginIpCountryCounterDefaultValue()
    {
        $this->assertEquals(0, $this->counter->getFailedLoginIpCountryCounter());
    }

    public function testFailedLoginIpCountryCounterIncreaseValue()
    {
        $failedAttempts = 105;

        for ($i = 1; $i <= $failedAttempts; $i++)
        {
            $this->counter->increaseFailedLoginIpCountryCounter();
        }

        $this->assertEquals($failedAttempts, $this->counter->getFailedLoginIpCountryCounter());
    }

    public function testFailedLoginUsernameCounterDefaultValue()
    {
        $this->assertEquals(0, $this->counter->getFailedLoginUsernameCounter());
    }

    public function testFailedLoginUsernameCounterIncreaseValue()
    {
        $failedAttempts = 3;

        for ($i = 1; $i <= $failedAttempts; $i++)
        {
            $this->counter->increaseFailedLoginUsernameCounter();
        }

        $this->assertEquals($failedAttempts, $this->counter->getFailedLoginUsernameCounter());
    }
}
 