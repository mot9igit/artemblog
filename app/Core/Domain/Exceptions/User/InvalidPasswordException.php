<?php


namespace App\Core\Domain\Exceptions\User;

use Exception;

class InvalidPasswordException extends Exception
{
    public function __construct()
    {
        parent::__construct('Invalid password.');
    }
}
