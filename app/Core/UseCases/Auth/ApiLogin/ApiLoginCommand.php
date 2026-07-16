<?php

namespace App\Core\UseCases\Auth\ApiLogin;
readonly class ApiLoginCommand
{
    public function __construct(
        public readonly string $email,
        public readonly string $password
    )
    {}
}
