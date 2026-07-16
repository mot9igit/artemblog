<?php

namespace App\Core\Ports\Auth;

interface TokenRevokerPort
{
    public function revoke(string $tokenId): void;
}
