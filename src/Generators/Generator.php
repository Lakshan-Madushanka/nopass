<?php

namespace LakM\NoPass\Generators;

use Illuminate\Foundation\Auth\User;
use LakM\NoPass\Enums\Login;

readonly class Generator
{
    public function __construct(
        private Login $type,
        private User $user,
        private int $expireAfter,
        private ?string $routeName = null,
    ) {}

    public function generate(array $data = []): string
    {
        return match ($this->type) {
            Login::OTP => (new OTPGenerator(
                $this->user, $this->expireAfter
            ))->generate(),
            Login::EMAIL => (new EmailGenerator(
                user: $this->user,
                expireAfter: $this->expireAfter,
                routeName: $this->routeName,
            ))->generate($data),
        };
    }
}
