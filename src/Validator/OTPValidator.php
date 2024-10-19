<?php

declare(strict_types=1);

namespace LakM\NoPass\Validator;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Timebox;
use LakM\NoPass\CacheService;

class OTPValidator implements ValidatorContract
{
    public function __construct(private readonly string|int $otp) {}

    public function validate(User $user): bool
    {
        return (new Timebox())
            ->call(function () use ($user) {
                $data = explode(';', CacheService::get($user));
                return (bool) ($data[1] === 'otp' && sha1((string) $this->otp) === $data[0]);
            }, 200 * 1000);
    }

    public function validateId(User $user, Request $request): bool
    {
        return $this->getId($user) === $request->query('id');
    }

    public function validateEmail(User $user, Request $request): bool
    {
        return hash_equals(sha1($user->getEmailForVerification()), $request->query('email'));
    }

    public function getId(User $user): ?string
    {
        $value = CacheService::get($user);

        return explode(';', $value)[0];
    }
}
