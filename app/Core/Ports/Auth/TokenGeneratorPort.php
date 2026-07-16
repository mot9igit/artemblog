<?php

namespace App\Core\Ports\Auth;

use App\Core\Domain\Entities\UserEntity;

interface TokenGeneratorPort
{
    public function create(UserEntity $user, string $name, array $abilities = ['*']): string;
}
