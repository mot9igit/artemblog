<?php

namespace App\Core\UseCases\Auth\Me;

readonly class MeCommand
{
    public function __construct(
        public string $userId,
    ) {}
}
