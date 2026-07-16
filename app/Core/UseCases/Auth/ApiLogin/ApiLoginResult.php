<?php

namespace App\Core\UseCases\Auth\ApiLogin;

use App\Core\Domain\Entities\UserEntity;

readonly class ApiLoginResult
{
    public function __construct(
        public UserEntity $user,
        public string     $token,
    ) {}
}
