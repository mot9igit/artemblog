<?php

namespace App\Core\UseCases\User\Create;

use App\Core\Domain\ValueObjects\Modules\File\FileValueObject;

readonly class CreateUserCommand
{
    public function __construct(
        public readonly string          $name,
        public readonly string           $email,
        public readonly ?string         $phone,
        public readonly ?string         $fullname,
        public readonly string          $password,
        public readonly ?FileValueObject $avatar,
        public readonly bool            $active,
        public readonly bool            $sudo,
        public readonly ?array          $properties = null,
    ) {}
}
