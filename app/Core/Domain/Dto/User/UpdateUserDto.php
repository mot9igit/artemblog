<?php

namespace App\Core\Domain\Dto\User;

readonly class UpdateUserDto
{
    public function __construct(
        public ?string $name = null,
        public ?string $email = null,
        public ?string $phone = null,
        public ?string $fullname = null,
        public ?string $password = null,
        public mixed   $avatar = null,
        public ?bool   $active = null,
        public ?bool   $sudo = null,
        public ?string $resetPasswordToken = null,
        public ?array  $roles = [],
        public mixed   $properties = null,
    ) {}
}
