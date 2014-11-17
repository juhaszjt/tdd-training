<?php

namespace FraudSystem\Homework04_2;

class Login
{
    // - if the login is successful we reset the counters.
    public function successfulLogin(Captcha $captcha, Counter $counter)
    {
        $captcha->setCaptchaStatus(false);
        
        $counter->resetFailedLoginIpCounter();
        $counter->resetFailedLoginIpRangeCounter();
        $counter->resetFailedLoginIpCountryCounter();
        $counter->resetFailedLoginUsernameCounter();
    }
    
    public function checkCaptchaAfterUnSuccessfulLoginFromIp(Counter $counter)
    {
        $showCaptcha = false;

        $counter->increaseFailedLoginIpCounter();

        // If we have a failed login from an ip we must increase the ip, 
        // the range and the country counter till the captcha is not active. 
        if ($counter->getFailedLoginIpCounter() <= Counter::CAPTCHA_STATUS_SWITCH_FAILED_LOGIN_IP_ATTEMPTS)
        {
            $counter->increaseFailedLoginIpRangeCounter();
            $counter->increaseFailedLoginIpCountryCounter();
        }

        // - from the same ip we have 3 failed login or
        // - from the same ip range we have 500 failed login or
        // - from the same country we have 1000 failed login
        if (
            $counter->getFailedLoginIpCounter() >= Counter::CAPTCHA_STATUS_SWITCH_FAILED_LOGIN_IP_ATTEMPTS
            || $counter->getFailedLoginIpRangeCounter() >= Counter::CAPTCHA_STATUS_SWITCH_FAILED_LOGIN_IP_RANGE_ATTEMPTS
            || $counter->getFailedLoginIpCountryCounter() >= Counter::CAPTCHA_STATUS_SWITCH_FAILED_LOGIN_IP_COUNTRY_ATTEMPTS
        ) {
            $showCaptcha = true;
        }

        return $showCaptcha;
    }

    // - from the same ip range we have 500 failed login
    public function checkCaptchaAfterUnSuccessfulLoginFromRange(Counter $counter)
    {
        $showCaptcha = false;

        $counter->increaseFailedLoginIpRangeCounter();

        if ($counter->getFailedLoginIpRangeCounter() >= Counter::CAPTCHA_STATUS_SWITCH_FAILED_LOGIN_IP_RANGE_ATTEMPTS)
        {
            $showCaptcha = true;
        }

        return $showCaptcha;
    }

    // - from the same country we have 1000 failed login
    public function checkCaptchaAfterUnSuccessfulLoginFromCountry(Counter $counter)
    {
        $showCaptcha = false;

        $counter->increaseFailedLoginIpCountryCounter();

        if ($counter->getFailedLoginIpCountryCounter() >= Counter::CAPTCHA_STATUS_SWITCH_FAILED_LOGIN_USERNAME_ATTEMPTS)
        {
            $showCaptcha = true;
        }

        return $showCaptcha;
    }
    
    // - with the same username we have 3 failed login
    public function checkCaptchaAfterUnSuccessfulUsernameLogin(Counter $counter)
    {
        $showCaptcha = false;

        $counter->increaseFailedLoginUsernameCounter();

        if ($counter->getFailedLoginUsernameCounter() >= Counter::CAPTCHA_STATUS_SWITCH_FAILED_LOGIN_USERNAME_ATTEMPTS)
        {
            $showCaptcha = true;
        }

        return $showCaptcha;
    }
    
    // if the username registration country is different from the client country (from geoip) and the login has failed, 
    // then you need to activate the captcha to the next try.
    public function checkRegistrationAndActualCountryAfterFailedLogin(User $user, $loginCountry)
    {
        $showCaptcha = false;
        
        $registrationCountry = $user->getRegistrationCountry();
        
        if ($registrationCountry != $loginCountry)
        {
            $showCaptcha = true;
        }
        
        return $showCaptcha;
    }
}
