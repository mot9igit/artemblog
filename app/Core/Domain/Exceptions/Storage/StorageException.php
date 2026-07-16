<?php


namespace App\Core\Domain\Exceptions\Storage;

use Exception;

class StorageException extends Exception
{
    public function __construct(
        string      $message,
        ?\Throwable $previous = null,
    )
    {
        parent::__construct($message, 0, $previous);
    }
}
