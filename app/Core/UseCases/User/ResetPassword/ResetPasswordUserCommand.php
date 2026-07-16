<?php


namespace App\Core\UseCases\User\ResetPassword;
readonly class ResetPasswordUserCommand
{
    public function __construct(
        public string $email,
    )
    {
    }
}
