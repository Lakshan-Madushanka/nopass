<?php

namespace LakM\NoPass\Generators;

use LakM\NoPass\CacheService;
use LakM\NoPass\Enums\Login;
use Random\RandomException;

class OTPGenerator extends AbstractGenerator
{
    /**
     * @throws RandomException
     */
    public function generate(): string
    {
        $code = str_pad((string) random_int(0, 99999), 5, '0', STR_PAD_LEFT);

        $id = sha1($code);

        CacheService::put($this->user, $id, Login::OTP, $this->expireAfter);

        return $code;
    }
}
