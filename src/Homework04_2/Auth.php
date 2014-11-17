<?php

namespace FraudSystem\Homework04_2;

use FraudSystem\Homework04_2\User;
use FraudSystem\Homework04_2\Counter;
use FraudSystem\Homework04_2\Login;
use FraudSystem\Homework04_2\Captcha;
use FraudSystem\Homework04_2\ErrorLog;
use FraudSystem\Homework04_2\LoginAttempt;

class Auth
{
    private $user;
    private $counter;
    private $captcha;
    private $login;
    
    public function __construct(
        User $user, 
        Counter $counter, 
        Captcha $captcha, 
        Login $login,
        // password, country, time, ip...
        LoginAttempt $loginAttempt,
    ) {
        $this->user         = $user;
        $this->counter      = $counter;
        $this->captcha      = $captcha;
        $this->login        = $login;
        $this->loginAttempt = $loginAttempt;
    }
    
    public function authenticate() 
    {
        $errorCode = $this->checkAuthenticate();
        
        if ($errorCode === 0)
        {
            $login->successfulLogin($this->captcha, $this->counter);
        }
        else
        {
            // - the counter logs the failed logins continuously.
            $errorLog = new ErrorLog($this->user, $this->loginAttempt);
            
            $login->checkRegistrationAndActualCountryAfterFailedLogin($this->user, $this->loginAttempt->getLoginCountry());
            
            switch($errorCode) {
                // failed login from same ip
                case 1:
                    $login->checkCaptchaAfterUnSuccessfulLoginFromIp($this->counter);
                    break;
                
                // failed login from same ip range
                case 2:
                    $login->checkCaptchaAfterUnSuccessfulLoginFromRange($this->counter);
                    break;
                    
                // failed login from same country
                case 3:
                    $login->checkCaptchaAfterUnSuccessfulLoginFromCountry($this->counter);
                    break;
                    
                // failed login with same username
                case 4:
                    $login->checkCaptchaAfterUnSuccessfulUsernameLogin($this->counter);
                    break;
                    
                default:
                    throw new \InvalidArgumentException('Invalid error code: ' . print_r($errorCode, 1));
            }
        }
    }
    
    private function authenticateProcess()
    {
        // @todo: authenticate process
        // check $this->loginAttempt
        return $errorCode;
    }
}
