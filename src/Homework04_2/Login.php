<?php
/**
 * Created by PhpStorm.
 * User: jani
 * Date: 20/10/2014
 * Time: 22:05
 */

namespace FraudSystem\Homework04_2;

class Login
{
    public function successfulLogin(Captcha $captcha, Counter $counter)
    {
        $captcha->resetCaptcha();
        
        $counter->resetFailedLoginIpCounter();
        $counter->resetFailedLoginIpRangeCounter();
        $counter->resetFailedLoginIpCountryCounter();
        $counter->resetFailedLoginUsernameCounter();
        
        return true;
    }
    
    public function showCaptchaAfterUnSuccessfulLoginFromIp(Counter $counter)
    {
        $showCaptcha = false;

        $counter->increaseFailedLoginIpCounter();

        if ($counter->getFailedLoginIpCounter() <= Counter::CAPTCHA_STATUS_SWITCH_FAILED_LOGIN_IP_ATTEMPTS)
        {
            $counter->increaseFailedLoginIpRangeCounter();
            $counter->increaseFailedLoginIpCountryCounter();
        }

        if (
            $counter->getFailedLoginIpCounter() >= Counter::CAPTCHA_STATUS_SWITCH_FAILED_LOGIN_IP_ATTEMPTS
            || $counter->getFailedLoginIpRangeCounter() >= Counter::CAPTCHA_STATUS_SWITCH_FAILED_LOGIN_IP_RANGE_ATTEMPTS
            || $counter->getFailedLoginIpCountryCounter() >= Counter::CAPTCHA_STATUS_SWITCH_FAILED_LOGIN_IP_COUNTRY_ATTEMPTS
        ) {
            $showCaptcha = true;
        }

        return $showCaptcha;
    }

    public function showCaptchaAfterUnSuccessfulLoginFromRange(Counter $counter)
    {
        $showCaptcha = false;

        $counter->increaseFailedLoginIpRangeCounter();

        if ($counter->getFailedLoginIpRangeCounter() >= Counter::CAPTCHA_STATUS_SWITCH_FAILED_LOGIN_IP_RANGE_ATTEMPTS)
        {
            $showCaptcha = true;
        }

        return $showCaptcha;
    }

    public function showCaptchaAfterUnSuccessfulLoginFromCountry(Counter $counter)
    {
        $showCaptcha = false;

        $counter->increaseFailedLoginIpCountryCounter();

        if ($counter->getFailedLoginIpCountryCounter() >= Counter::CAPTCHA_STATUS_SWITCH_FAILED_LOGIN_IP_COUNTRY_ATTEMPTS)
        {
            $showCaptcha = true;
        }

        return $showCaptcha;
    }
}
