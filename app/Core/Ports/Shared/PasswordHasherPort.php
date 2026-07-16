<?php

namespace App\Core\Ports\Shared;
interface PasswordHasherPort
{
    public function hash(string $password): string;

    public function verify(string $passwordHash, string $password): bool;
}
