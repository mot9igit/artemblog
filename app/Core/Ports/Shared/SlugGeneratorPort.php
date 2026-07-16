<?php

namespace App\Core\Ports\Shared;
interface SlugGeneratorPort
{
    public function generate(string $text): string;
}
