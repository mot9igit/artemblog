<?php

namespace App\Infrastructure\Adapters\Shared;

use App\Core\Ports\Shared\MailPort;
use Illuminate\Support\Facades\Mail;

class MailAdapter implements MailPort
{
    public function send(string $to, string $subject, string $template, array $data = []): void
    {
        Mail::send($template, $data, function ($message) use ($to, $subject) {
            $message->to($to)
                ->subject($subject);
        });
    }
}
