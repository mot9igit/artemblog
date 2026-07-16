<?php

namespace App\Core\Domain\Exceptions\User;
use Exception;

class UserNotFoundByTokenException extends Exception
{
    public function __construct()
    {
        parent::__construct('User not found by token');
    }
}
