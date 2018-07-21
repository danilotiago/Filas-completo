<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var string
     */
    private $mensagem;

    /**
     * Create a new message instance.
     *
     * @param string $mensagem
     */
    public function __construct(string $mensagem)
    {
        $this->mensagem = $mensagem;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env("MAIL_FROM"))->view('emails.welcome-mail')->with([
            'mensagem' => $this->mensagem
        ]);
    }
}
