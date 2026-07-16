<?php

namespace App\Infrastructure\Adapters\Auth;

use App\Core\Domain\Entities\UserEntity;
use App\Core\Ports\Auth\TokenGeneratorPort;
use App\Infrastructure\Adapters\Database\Models\User;

class SanctumTokenGeneratorAdapter implements TokenGeneratorPort
{
    public function create(UserEntity $user, string $name, array $abilities = ['*']): string
    {
        $model = User::query()->find($user->id);

        if (!$model) {
            throw new \RuntimeException("User model not found for id: {$user->id}");
        }

        return $model->createToken($name, $abilities)->plainTextToken;
    }
}
