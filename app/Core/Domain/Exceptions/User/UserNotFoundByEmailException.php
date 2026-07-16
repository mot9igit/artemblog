<?php

namespace App\Core\Domain\Exceptions\User;
use Exception;

class UserNotFoundByEmailException extends Exception
{
    public function __construct(string $email)
    {
        parent::__construct('User not found for email ' . $email);
    }
}
