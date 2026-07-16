<?php


namespace App\Infrastructure\Adapters\Shared;

use App\Core\Ports\Shared\PasswordHasherPort;
use Illuminate\Support\Facades\Hash;

class PasswordHasherAdapter implements PasswordHasherPort
{

    public function hash(string $password): string
    {
        // TODO: Implement hash() method.
        throw new \Exception('Not implemented');
    }

    public function verify(string $passwordHash, string $password): bool
    {
        return !!Hash::check($password, $passwordHash);
    }
}
