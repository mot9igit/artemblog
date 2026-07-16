<?php

namespace App\Core\UseCases\User\Delete;

class DeleteUserCommand
{
    public function __construct(
        public readonly string $id,
    ) {}
}
