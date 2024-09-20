<?php

declare(strict_types=1);

namespace LakM\NoPass\Validator;

use Illuminate\Foundation\Auth\User;

interface ValidatorContract
{
    public function validate(User $user): bool;
}
