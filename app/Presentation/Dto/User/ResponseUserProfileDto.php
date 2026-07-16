<?php

namespace App\Presentation\Dto\User;

readonly class ResponseUserProfileDto
{
    public function __construct(
        public string     $id,
        public string  $name,
        public string  $email,
        public ?string $phone,
        public ?string $fullname,
        public bool    $active,
        public bool    $sudo,
        public ?string $avatar
    ) {}
}
