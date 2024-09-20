<?php

use Illuminate\Support\Facades\Route;
use LakM\NoPass\Enums\Login;
use LakM\NoPass\NoPassManager;
use LakM\NoPass\Validator\Validator;

it('can get login type', function () {
    Route::get('/login-link', function () {})->name('login-link');

    $user = user();

    (new NoPassManager)
        ->for($user)
        ->email()
        ->routeName('login-link')
        ->generate();

    $validator = new Validator;

    expect($validator->getType($user))->toBe(Login::EMAIL);
});
