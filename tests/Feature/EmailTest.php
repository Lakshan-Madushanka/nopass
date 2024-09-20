<?php

use Illuminate\Support\Facades\Route;
use LakM\NoPass\CacheService;
use LakM\NoPass\Facades\NoPass;
use LakM\NoPass\NoPassManager;

use function Pest\Laravel\get;
use function Pest\Laravel\getJson;

it('can generate a login link', function () {
    Route::get('/login-link', function () {})->name('login-link');

    $user = user();

    $noPass = (new NoPassManager)
        ->for($user)
        ->email()
        ->routeName('login-link')
        ->generate();

    ['path' => $path, 'query' => $queryString] = parse_url($noPass);

    $query = [];

    parse_str($queryString, $query);

    expect($path)->toBe('/login-link')
        ->and($query['email'])
        ->toBe(sha1($user->email));

    $value = explode(';', CacheService::get($user));

    expect($value[0])->toBe($query['id'])
        ->and($value[1])->toBe('email');
});

it('can validate login link', function () {
    Route::get('/login-link', function () {})->name('login-link');

    $user = user();

    $noPass = (new NoPassManager)
        ->for($user)
        ->email()
        ->routeName('login-link');

    $link = $noPass->generate();

    Route::get('/login-link', function () use ($noPass) {
        return $noPass->isValid() ? true : abort(403);
    })->name('login-link');


    getJson($link)->assertOk();
    get($link.'&test=test')->assertForbidden();
});

it('can inValidate previous login link', function () {
    Route::get('/login-link', function () {})->name('login-link');

    $user = user();

    $noPass = (new NoPassManager)
        ->for($user)
        ->email()
        ->routeName('login-link');

    $link = $noPass->generate(['name' => 'a', 'email' => 'b']);
    $noPass->generate();

    Route::get('/login-link', function () use ($noPass) {
        expect($noPass->isValid())->toBeFalse();
    })->name('login-link');

    get($link)->assertOk();
});

it('can invalidate a link', function () {
    Route::get('/login-link', function () {})->name('login-link');

    $user = user();

    $noPass = (new NoPassManager)
        ->for($user)
        ->email()
        ->routeName('login-link');

    $link = $noPass->generate();

    expect($noPass->inValidate())->toBeTrue();

    Route::get('/login-link', function () use ($noPass) {
        expect($noPass->isValid())->toBeFalse();
    })->name('login-link');

    get($link)->assertOk();
});
