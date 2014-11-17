<?php

namespace FraudSystem\Homework04_2;

class User
{
    private $registrationCountry = '';

    /**
     * @return string
     */
    public function getRegistrationCountry()
    {
        return $this->registrationCountry;
    }

    public function setRegistrationCountry($country)
    {
        if (
            is_string($country)
            && strlen($country) == 2
        ) {
            $this->registrationCountry = $country;
        }
        else
        {
            throw new \InvalidArgumentException('Invalid registration country: ' . print_r($country, 1));
        }
    }
}
