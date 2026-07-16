<?php

namespace App\Core\Ports\Shared;
interface MailPort
{
    public function send(string $to, string $subject, string $template, array $data = []): void;
}
