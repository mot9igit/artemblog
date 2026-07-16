<?php

namespace App\Presentation\Dto\User;

readonly class ResponseUserDto
{
    public function __construct(
        public readonly string     $id,
        public readonly string  $name,
        public readonly string  $email,
        public readonly ?string $phone,
        public readonly ?string $fullname,
        public readonly bool    $active,
        public readonly bool    $sudo,
        public readonly ?string $avatar
    ) {}
}

