<?php

namespace App\Core\UseCases\User\FindAll;

readonly class FindAllUserCommand
{
    public function __construct(
        public ?string $search = null,
        public ?string $name = null,
        public ?string $email = null,
        public ?bool   $active = null,
        public ?int    $page = null,
        public ?int    $limit = null,
    ) {}
}
