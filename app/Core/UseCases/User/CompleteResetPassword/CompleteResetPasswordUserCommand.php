<?php


namespace App\Core\UseCases\User\CompleteResetPassword;
readonly class CompleteResetPasswordUserCommand
{
    public function __construct(
        public string $token,
        public string $newPassword
    )
    {
    }
}
