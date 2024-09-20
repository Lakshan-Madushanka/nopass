<?php

declare(strict_types=1);

namespace LakM\NoPass\Generators;

use Illuminate\Foundation\Auth\User;

abstract class AbstractGenerator
{
    public function __construct(
        protected User $user,
        protected int $expireAfter,
        protected ?string $routeName = null,
        protected ?string $redirectUrl = null,
    ) {}

    abstract public function generate();
}
