<?php

namespace App\Infrastructure\Adapters\Shared;

use App\Core\Ports\Shared\SlugGeneratorPort;
use Illuminate\Support\Str;

class SlugGeneratorAdapter implements SlugGeneratorPort
{

    public function generate(string $text): string
    {
        return Str::slug($text);
    }
}
