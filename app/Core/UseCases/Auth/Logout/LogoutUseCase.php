<?php

namespace App\Core\UseCases\Auth\Logout;

use App\Core\Ports\Auth\TokenRevokerPort;

readonly class LogoutUseCase
{
    public function __construct(
        private TokenRevokerPort $tokenRevoker,
    ) {}

    public function execute(LogoutCommand $command): void
    {
        $this->tokenRevoker->revoke($command->tokenId);
    }
}
