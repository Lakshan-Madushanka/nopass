<?php

declare(strict_types=1);

namespace LakM\NoPass\Generators;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use LakM\NoPass\CacheService;
use LakM\NoPass\Enums\Login;

class EmailGenerator extends AbstractGenerator
{
    public function generate(array $data = []): string
    {
        $id = Str::random();

        $url = URL::temporarySignedRoute(
            name: $this->routeName,
            expiration: now()->addMinutes($this->expireAfter),
            parameters: [
                'email' => sha1($this->user->getEmailForVerification()),
                'redirect_url' => $this->redirectUrl,
                'id' => $id,
                ...$data,
            ],
        );

        $cached = CacheService::put($this->user, $id, Login::EMAIL, $this->expireAfter);

        return $url;
    }
}
