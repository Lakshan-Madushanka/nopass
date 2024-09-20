<?php

namespace LakM\NoPass\Validator;

use Illuminate\Foundation\Auth\User;

interface ValidatorContract
{
    public function validate(User $user): bool;
}
