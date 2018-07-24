<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class WorkerNotification extends Notification
{
    private $message;
    private $title;

    /**
     * Create a new notification instance.
     *
     * @param string $title
     * @param string $message
     */
    public function __construct(string $title, string$message)
    {
        $this->message = $message;
        $this->title = $title;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array
     */
    public function via()
    {
        return ['slack'];
    }

    /**
     * Executa a notificacao
     *
     * @return SlackMessage
     */
    public function toSlack()
    {
        $data = [
            'title'   => $this->title,
            'message' => $this->message,
            'date'    => date("d/m/Y à\s H:i")
        ];
        return (new SlackMessage)->attachment(function ($attachment) use ($data) {
            $attachment
                ->title($data['title'])
                ->content("{$data['message']} \n em {$data['date']}")
                ->color("#fbbc05");
        });
    }
}
