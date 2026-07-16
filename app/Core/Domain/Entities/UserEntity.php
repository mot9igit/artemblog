<?php
namespace App\Core\Domain\Entities;

use App\Core\Domain\Enums\User\Role;

readonly class UserEntity
{
    public function __construct(
        public string  $id,
        public string  $name,
        public string  $email,
        public ?string $phone,
        public ?string $fullname,
        public string  $password,
        public bool    $active,
        public bool    $sudo,
        public ?string $avatar,
        public ?string $resetPasswordToken,
        /**
         * @var Role[]
         */
        public array $roles,
    ) {}
}
