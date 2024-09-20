<?php

declare(strict_types=1);

namespace LakM\NoPass\Generators;

use Illuminate\Foundation\Auth\User;
use LakM\NoPass\Enums\Login;

class Generator
{
    public function __construct(
        private readonly Login $type,
        private readonly User $user,
        private readonly int $expireAfter,
        private readonly ?string $routeName = null,
    ) {}

    public function generate(array $data = []): string
    {
        return match ($this->type) {
            Login::OTP => (new OTPGenerator(
                $this->user,
                $this->expireAfter,
            ))->generate(),
            Login::EMAIL => (new EmailGenerator(
                user: $this->user,
                expireAfter: $this->expireAfter,
                routeName: $this->routeName,
            ))->generate($data),
        };
    }
}
