<?php

namespace App\Infrastructure\Adapters\Auth;

use App\Core\Ports\Auth\TokenRevokerPort;
use Laravel\Sanctum\PersonalAccessToken;

class SanctumTokenRevokerAdapter implements TokenRevokerPort
{
    public function revoke(string $tokenId): void
    {
        $token = PersonalAccessToken::find($tokenId);
        $token?->delete();
    }
}
