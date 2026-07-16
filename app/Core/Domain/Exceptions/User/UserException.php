<?php

namespace App\Core\Domain\Exceptions\User;

use Exception;

class UserException extends Exception
{
    public function __construct(
        string $message = "User error",
        public int $status = 400,
        public array $errors = [],
        int $code = 0,
        ?\Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
