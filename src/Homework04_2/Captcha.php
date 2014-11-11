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
    private $captchaStatus = false;

    /**
     * @return boolean
     */
    public function getCaptchaStatus()
    {
        return $this->captchaStatus;
    }

    public function setCaptchaStatus($status)
    {
        if (is_bool($status))
        {
            $this->captchaStatus = $status;
        }
        else
        {
            throw new \InvalidArgumentException('Invalid captcha status: ' . $status);
        }
    }
}
