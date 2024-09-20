<?php

declare(strict_types=1);

namespace LakM\NoPass;

use Illuminate\Foundation\Auth\User;
use LakM\NoPass\Enums\Login;
use LakM\NoPass\Generators\Generator;
use LakM\NoPass\Validator\Validator;

class NoPassManager
{
    private User $user;

    /**
     * Two types available email or otp
     */
    private Login $type;

    /**
     * Expire time in minutes
     */
    private int $expireAfter = 5;

    /**
     * Route which email type login link generate for
     */
    private ?string $routeName = null;

    public function for(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function email(): self
    {
        $this->type = Login::EMAIL;

        return $this;
    }

    public function otp(): self
    {
        $this->type = Login::OTP;

        return $this;
    }

    public function expireAfter(int $expireAfter): self
    {
        $this->expireAfter = $expireAfter;

        return $this;
    }

    public function routeName(?string $name): self
    {
        $this->routeName = $name;

        return $this;
    }

    public function generate(array $data = []): string
    {
        return (new Generator(
            type: $this->type,
            user: $this->user,
            expireAfter: $this->expireAfter,
            routeName: $this->routeName,
        ))
            ->generate($data);
    }

    public function inValidate(): bool
    {
        return CacheService::remove($this->user);
    }

    public function isValid(string|int|null $otp = null): bool
    {
        return (new Validator())->isValid($this->user, $otp);
    }
}
