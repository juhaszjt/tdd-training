<?php

namespace FraudSystem\Homework04_2;

use FraudSystem\Homework04_2\User;
use FraudSystem\Homework04_2\Counter;
use FraudSystem\Homework04_2\Login;
use FraudSystem\Homework04_2\Captcha;
use FraudSystem\Homework04_2\ErrorLog;
use FraudSystem\Homework04_2\LoginAttempt;

class LoginAuth
{
    private $user;
    private $counter;
    private $captcha;
    private $login;
    private $loginAttempt;
    
    public function authenticateProcess(
        User $user, 
        Counter $counter, 
        Captcha $captcha, 
        Login $login,
        // password, country, time, ip, errorCode...
        LoginAttempt $loginAttempt
    ) {
        $this->user         = $user;
        $this->counter      = $counter;
        $this->captcha      = $captcha;
        $this->login        = $login;
        $this->loginAttempt = $loginAttempt;
    
        $errorCode = $this->loginAttempt->getErrorCode();
        
        if ($errorCode === 0)
        {
            $login->successfulLogin($this->captcha, $this->counter);
        }
        else
        {
            // - the counter logs the failed logins continuously.
            $errorLog = new ErrorLog($this->user, $this->loginAttempt);
            
            $captchaStatus = $login->checkRegistrationAndActualCountryAfterFailedLogin($this->captcha, $this->user, $this->loginAttempt->getLoginCountry());
            
            if ($captchaStatus !== true) 
            {            
                switch($errorCode) {
                    // failed login from same ip
                    case 1:
                        $login->checkCaptchaAfterUnSuccessfulLoginFromIp($this->captcha, $this->counter);
                        break;
                    
                    // failed login from same ip range
                    case 2:
                        $login->checkCaptchaAfterUnSuccessfulLoginFromRange($this->captcha, $this->counter);
                        break;
                        
                    // failed login from same country
                    case 3:
                        $login->checkCaptchaAfterUnSuccessfulLoginFromCountry($this->captcha, $this->counter);
                        break;
                        
                    // failed login with same username
                    case 4:
                        $login->checkCaptchaAfterUnSuccessfulUsernameLogin($this->captcha, $this->counter);
                        break;
                        
                    default:
                        throw new \InvalidArgumentException('Invalid error code: ' . print_r($errorCode, 1));
                }
            }
        }
    }
}
