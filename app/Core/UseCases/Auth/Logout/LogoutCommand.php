<?php

namespace App\Core\UseCases\Auth\Logout;

readonly class LogoutCommand
{
    public function __construct(
        public string $tokenId,
    ) {}
}
