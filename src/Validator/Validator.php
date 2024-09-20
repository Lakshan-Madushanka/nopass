<?php

declare(strict_types=1);

namespace LakM\NoPass\Validator;

use Illuminate\Foundation\Auth\User;
use LakM\NoPass\CacheService;
use LakM\NoPass\Enums\Login;

class Validator
{
    private $validator;

    public function isValid(User $user, string|int|null $otp = null): bool
    {
        if ( ! $this->checkKeyExists($user)) {
            return false;
        }

        return $this->getValidator($user, $otp)->validate($user);
    }

    public function checkKeyExists(User $user): bool
    {
        return CacheService::check($user);
    }

    public function getValidator(User $user, string|int|null $otp = null): ValidatorContract
    {
        if (isset($this->validator)) {
            return $this->validator;
        }

        $validator = match ($this->getType($user)) {
            Login::EMAIL => new EmailValidator(),
            Login::OTP => new OTPValidator($otp),
        };

        $this->validator = $validator;

        return $this->validator;
    }

    public function getType(User $user): Login
    {
        $value = CacheService::get($user);

        return Login::from(explode(';', $value)[1]);
    }
}
