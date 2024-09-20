<?php

use LakM\NoPass\CacheService;
use LakM\NoPass\Enums\Login;

use function Pest\Laravel\travel;

it('can get cache key name', function () {
    $user = user();

    expect(CacheService::getCachedKey($user))
        ->toBe('nopass-'.$user->getKey());
});

it('can store cache for a defined time limit', function () {
    $user = user();

    CacheService::put($user, 'test_value', Login::EMAIL, 5);

    expect(CacheService::get($user))->toBe('test_value;email');

    travel(6)->minutes();

    expect(CacheService::get($user))->toBeNull();
});

it('can remove cache data', function () {
    $user = user();

    CacheService::put($user, 'test_value', Login::EMAIL, 5);
    expect(CacheService::get($user))->toBe('test_value;email');

    CacheService::remove($user);
    expect(CacheService::get($user))->toBeNull();
});
