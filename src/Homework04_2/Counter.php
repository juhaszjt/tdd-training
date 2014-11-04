<?php
/**
 * Created by PhpStorm.
 * User: jani
 * Date: 19/10/2014
 * Time: 23:03
 */

namespace FraudSystem\Homework04_2;

class Counter
{
    const CAPTCHA_STATUS_SWITCH_FAILED_LOGIN_IP_ATTEMPTS         = 3;
    const CAPTCHA_STATUS_SWITCH_FAILED_LOGIN_IP_RANGE_ATTEMPTS   = 500;
    const CAPTCHA_STATUS_SWITCH_FAILED_LOGIN_IP_COUNTRY_ATTEMPTS = 1000;
    const CAPTCHA_STATUS_SWITCH_FAILED_LOGIN_USERNAME_ATTEMPTS   = 3;

    private $failedLoginIpCounter        = 0;
    private $failedLoginIpRangeCounter   = 0;
    private $failedLoginIpCountryCounter = 0;
    private $failedLoginUsernameCounter  = 0;

    /**
     * @return int
     */
    public function getFailedLoginIpCounter()
    {
        return $this->failedLoginIpCounter;
    }

    public function increaseFailedLoginIpCounter()
    {
        $this->failedLoginIpCounter++;
    }

	public function resetFailedLoginIpCounter()
    {
        $this->failedLoginIpCounter = 0;
    }
	
    /**
     * @return int
     */
    public function getFailedLoginIpRangeCounter()
    {
        return $this->failedLoginIpRangeCounter;
    }

    public function increaseFailedLoginIpRangeCounter()
    {
        $this->failedLoginIpRangeCounter++;
    }

	public function resetFailedLoginIpRangeCounter()
    {
        $this->failedLoginIpRangeCounter = 0;
    }
	
    /**
     * @return int
     */
    public function getFailedLoginIpCountryCounter()
    {
        return $this->failedLoginIpCountryCounter;
    }

    public function increaseFailedLoginIpCountryCounter()
    {
        $this->failedLoginIpCountryCounter++;
    }
	
	public function resetFailedLoginIpCountryCounter()
    {
        $this->failedLoginIpCountryCounter = 0;
    }

    /**
     * @return int
     */
    public function getFailedLoginUsernameCounter()
    {
        return $this->failedLoginUsernameCounter;
    }

    public function increaseFailedLoginUsernameCounter()
    {
        $this->failedLoginUsernameCounter++;
    }

    public function resetFailedLoginUsernameCounter()
    {
        $this->failedLoginUsernameCounter = 0;
    }
}
