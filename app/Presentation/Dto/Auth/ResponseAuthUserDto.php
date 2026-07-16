<?php

namespace App\Presentation\Dto\Auth;

readonly class ResponseAuthUserDto
{
    public function __construct(
        public string  $id,
        public string  $name,
        public string  $email,
        public ?string $phone,
        public ?string $fullname,
        public bool    $active,
        public bool    $sudo,
        public ?string $avatar
    ) {}
}
