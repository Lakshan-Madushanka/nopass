<?php

declare(strict_types=1);

namespace LakM\NoPass\Tests\Fixtures;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
    ];
}
