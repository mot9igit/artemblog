<?php

namespace App\Core\Domain\Exceptions\Storage;

class StorageFileNotFoundException extends StorageException
{
    public function __construct(
        string $message = "Файл не найден",
        ?\Throwable $previous = null,
    )
    {
        parent::__construct($message, $previous);
    }
}
