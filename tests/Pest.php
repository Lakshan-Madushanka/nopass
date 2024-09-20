<?php

declare(strict_types=1);

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use LakM\NoPass\Tests\Fixtures\User;
use LakM\NoPass\Tests\TestCase;

uses(TestCase::class, LazilyRefreshDatabase::class)->in('Feature', 'Unit');

function user(): User
{
    return User::query()
        ->create([
            'name' => fake()->name(),
            'email' => fake()->email(),
        ]);
}
