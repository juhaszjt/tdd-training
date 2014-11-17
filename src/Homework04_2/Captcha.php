<?php

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
            throw new \InvalidArgumentException('Invalid captcha status: ' . print_r($status, 1));
        }
    }
}
