<?php
/**
 * Created by PhpStorm.
 * User: jani
 * Date: 13/10/2014
 * Time: 20:36
 */
namespace FraudSystem\Homework04;

class Captcha
{
    private $captchaIsActive = false;

    private $failedLoginIp = 0;

    private $failedLoginIpRange = 0;

    private $failedLoginIpCountry = 0;

    private $failedLoginUsername = 0;

    const CAPTCHA_STATUS_SWITCH_FAILED_LOGIN_IP_ATTEMPTS = 3;
    const CAPTCHA_STATUS_SWITCH_FAILED_LOGIN_IP_RANGE_ATTEMPTS = 500;
    const CAPTCHA_STATUS_SWITCH_FAILED_LOGIN_IP_COUNTRY_ATTEMPTS = 1000;
    const CAPTCHA_STATUS_SWITCH_FAILED_LOGIN_USERNAME_ATTEMPTS = 3;

    /**
     * @return boolean
     */
    public function isCaptchaIsActive()
    {
        return $this->captchaIsActive;
    }

    /**
     * @return int
     */
    public function getFailedLoginIp()
    {
        return $this->failedLoginIp;
    }

    /**
     */
    public function increaseFailedLoginIp()
    {
        $this->failedLoginIp++;

        if ($this->failedLoginIp >= self::CAPTCHA_STATUS_SWITCH_FAILED_LOGIN_IP_ATTEMPTS)
        {
            if ($this->failedLoginIp == self::CAPTCHA_STATUS_SWITCH_FAILED_LOGIN_IP_ATTEMPTS)
            {
                $this->increaseFailedLoginIpRange();
                $this->increaseFailedLoginIpCountry();
            }

            $this->captchaIsActive = true;
        }
        else
        {
            $this->increaseFailedLoginIpRange();
            $this->increaseFailedLoginIpCountry();
        }
    }

    /**
     * @return int
     */
    public function getFailedLoginIpRange()
    {
        return $this->failedLoginIpRange;
    }

    /**
     */
    public function increaseFailedLoginIpRange()
    {
        $this->failedLoginIpRange++;

        if ($this->failedLoginIpRange >= self::CAPTCHA_STATUS_SWITCH_FAILED_LOGIN_IP_RANGE_ATTEMPTS)
        {
            $this->captchaIsActive = true;
        }
    }

    /**
     * @return int
     */
    public function getFailedLoginIpCountry()
    {
        return $this->failedLoginIpCountry;
    }

    /**
     */
    public function increaseFailedLoginIpCountry()
    {
        $this->failedLoginIpCountry++;

        if ($this->failedLoginIpCountry >= self::CAPTCHA_STATUS_SWITCH_FAILED_LOGIN_IP_COUNTRY_ATTEMPTS)
        {
            $this->captchaIsActive = true;
        }
    }

    /**
     * @return int
     */
    public function getFailedLoginUsername()
    {
        return $this->failedLoginUsername;
    }

    /**
     */
    public function increaseFailedLoginUsername()
    {
        $this->failedLoginUsername++;

        if ($this->failedLoginUsername >= self::CAPTCHA_STATUS_SWITCH_FAILED_LOGIN_USERNAME_ATTEMPTS)
        {
            $this->captchaIsActive = true;
        }
    }

    public function checkRegistrationAndActualCountryAfterFailedLogin($registrationCountry, $actualCountry)
    {
        if ($registrationCountry != $actualCountry)
        {
            $this->captchaIsActive = true;
        }
    }

    public function successfulLogin()
    {
        $this->captchaIsActive      = false;
        $this->failedLoginIp        = 0;
        $this->failedLoginIpRange   = 0;
        $this->failedLoginIpCountry = 0;
        $this->failedLoginUsername  = 0;
    }
}