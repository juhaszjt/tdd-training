<?php
/**
 * Created by PhpStorm.
 * User: jani
 * Date: 19/10/2014
 * Time: 22:34
 */

namespace FraudSystem\Homework04_2;

class Captcha
{
    private $captchaIsActive = false;

    /**
     * @return boolean
     */
    public function isCaptchaIsActive()
    {
        return $this->captchaIsActive;
    }

    public function setCaptchaToActive()
    {
        $this->captchaIsActive = true;
    }
	
    public function resetCaptcha()
    {
        $this->captchaIsActive = false;
    }
}
