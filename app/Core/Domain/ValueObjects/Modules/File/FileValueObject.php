<?php

namespace App\Core\Domain\ValueObjects\Modules\File;
class FileValueObject
{
    public function __construct(
        public string $buffer,
        public string $mimeType,
        public string $originalName,
    )
    {

    }
}
