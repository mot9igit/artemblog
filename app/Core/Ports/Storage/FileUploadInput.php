<?php

namespace App\Core\Ports\Storage;

class FileUploadInput {
    public function __construct(
        public string $key,
        public string $buffer,
        public string $mimeType,
    ) {}
}
