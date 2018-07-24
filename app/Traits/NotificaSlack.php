<?php

namespace App\Traits;

use Illuminate\Notifications\Notifiable;

trait NotificaSlack
{
    /*
     * Faz uso da notificacao
     */
    use Notifiable;

    /**
     * Define a URL de conexao API slack
     *
     * @return mixed
     */
    public function routeNotificationForSlack() {
        return env('SLACK_WEBHOOK_URL');
    }
}