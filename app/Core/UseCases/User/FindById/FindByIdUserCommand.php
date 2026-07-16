<?php

namespace App\Core\UseCases\User\FindById;

class FindByIdUserCommand
{
    public function __construct(
        public readonly string $id,
    ) {}
}
