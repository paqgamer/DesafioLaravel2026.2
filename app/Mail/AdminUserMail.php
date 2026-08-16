<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
// sinceramente nao  sei se esse é jeito certo, mas acho que  se funcionar ta ok
// eu  devia ter  sido menos teimoso e visto treinamentos ao invés de caçar tudo sozinho
class AdminUserMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $messageSubject,
        public string $messageBody,
    ) {}

    public function build()
    {
        return $this->subject($this->messageSubject)
            ->view('admin.emails.admin-message');
    }
}