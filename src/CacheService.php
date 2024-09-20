<?php

declare(strict_types=1);

namespace LakM\NoPass;

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Cache;
use LakM\NoPass\Enums\Login;

class CacheService
{
    public static function check(User $user): bool
    {
        return Cache::has(self::getCachedKey($user));
    }

    public static function get(User $user): ?string
    {
        return Cache::get(self::getCachedKey($user));
    }

    public static function put(User $user, string $id, Login $type, int $minutes): bool
    {
        $value = $id.';'.$type->value;

        return Cache::put(self::getCachedKey($user), $value, now()->addMinutes($minutes));
    }

    public static function remove(User $user): bool
    {
        return Cache::forget(self::getCachedKey($user));
    }

    public static function getCachedKey(User $user): string
    {
        return 'nopass-'.$user->getKey();
    }
}
