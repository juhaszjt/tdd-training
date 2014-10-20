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
    public function failedLogin(Counter $counter, Captcha $captcha, $errorCode)
    {
        switch($errorCode)
        {
            case 0:
                $counter->increaseFailedLoginIpCounter();
            case 1:
                $counter->increaseFailedLoginIpRangeCounter();
            case 2:
                $counter->getFailedLoginIpCountryCounter();
            case 3:
                $counter->increaseFailedLoginUsernameCounter();
        }
    }
}
