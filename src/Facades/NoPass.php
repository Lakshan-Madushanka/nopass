<?php

declare(strict_types=1);

namespace LakM\NoPass\Facades;

use Illuminate\Support\Facades\Facade;
use LakM\NoPass\NoPassManager;

/**
 * @mixin NoPassManager
 */
class NoPass extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return NoPassManager::class;
    }
}
