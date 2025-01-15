<?php

declare(strict_types=1);

namespace LakM\NoPass\Validator;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use LakM\NoPass\CacheService;

class EmailValidator implements ValidatorContract
{
    public function validate(User $user): bool
    {
        $request = request();

        if ( ! $request->hasValidSignature()) {
            return false;
        }

        if ( ! $this->validateId($user, $request)) {
            return false;
        }

        return ! ( ! $this->validateEmail($user, $request));
    }

    public function validateId(User $user, Request $request): bool
    {
        return $this->getId($user) === $request->query('id');
    }

    public function validateEmail(User $user, Request $request): bool
    {
        return sha1($user->getEmailForVerification()) === $request->query('email');
    }

    public function getId(User $user): ?string
    {
        $value = CacheService::get($user);

        return explode(';', $value)[0];
    }
}
