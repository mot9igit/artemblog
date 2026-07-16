<?php

namespace App\Core\Domain\Exceptions\Storage;

class StorageDeleteException extends StorageException
{
    public function __construct(
        string $message = "Ошибка при удалении файла",
        ?\Throwable $previous = null,
    )
    {
        parent::__construct($message, $previous);
    }
}
