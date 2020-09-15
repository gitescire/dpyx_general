<?php

namespace App\Notifications;

use App\Models\Evaluation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EvaluationFinishedNotification extends Notification
{
    use Queueable;

    private $evaluationIdEncoded;
    private $evaluatorIdEncoded;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Evaluation $evaluation)
    {
        $this->evaluationIdEncoded = base64_encode($evaluation->id);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $this->evaluatorIdEncoded = base64_encode($notifiable->id);

        return (new MailMessage)
            ->line('¡Una nueva evaluación ha sido completada y requiere un evaluador!')
            ->action('Asignarme la evaluación', route('evaluations.assign', [$this->evaluationIdEncoded, $this->evaluatorIdEncoded]))
            ->line('¡Gracias!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
