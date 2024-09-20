<?php

declare(strict_types=1);

namespace LakM\NoPass\Enums;

enum Login: string
{
    case EMAIL = 'email';
    case OTP = 'otp';
}
