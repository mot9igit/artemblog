<?php

namespace App\Core\Domain\ValueObjects\Modules\User;

class UserFiltersValueObject
{
    public function __construct(
        public ?string $search = null,
        public ?string $name = null,
        public ?string $email = null,
        public ?bool   $active = null,
    ) {}
}
