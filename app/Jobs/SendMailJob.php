<?php

namespace App\Jobs;

use App\Mail\WelcomeMail;
use App\Notifications\WorkerNotification;
use App\Traits\NotificaSlack;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /*
     * Faz uso da Trait de notificacao para slack
     */
    use NotificaSlack;

    /**
     * @var \stdClass
     */
    private $email;

    /**
     * Create a new job instance.
     *
     * @param \stdClass $email
     */
    public function __construct(\stdClass $email)
    {
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->email->destinatario)->send(new WelcomeMail($this->email->mensagem));

        // notifica via slack passando o objeto de notificacao padrao e uma mensagem
        $titulo = "[ENVIO DE EMAIL JOB]";
        $mensagem = "E-mail enviado com sucesso para: {$this->email->destinatario}";
        $this->notify(new WorkerNotification($titulo, $mensagem));
    }
}
