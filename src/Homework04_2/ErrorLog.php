<?php

namespace FraudSystem\Homework04_2;

class ErrorLog
{
    public function __construct(
        User $user, 
        // password, country, time, ip...
        LoginAttempt $loginAttempt,
    ) {
        // Log the errors
    }
}
