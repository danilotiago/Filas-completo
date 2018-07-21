<?php

namespace App\Http\Controllers;

use App\Jobs\SendMailJob;
use Illuminate\Http\Request;

class SendMailController extends Controller
{
    public function enviaEmail(Request $request)
    {
        $data = $request->all();

        $email = new \stdClass();
        $email->destinatario = $data['destinatario'];
        $email->mensagem = $data['mensagem'];

        $quantiadadeEnvios = $data['quantidade'];
        while ($quantiadadeEnvios > 0) {
            SendMailJob::dispatch($email)->onQueue('emails');
            $quantiadadeEnvios--;
        }

    }
}
