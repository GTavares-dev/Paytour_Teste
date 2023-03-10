<?php

namespace App\Notifications;

use App\Curriculo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewCurriculo extends Notification implements ShouldQueue
{
    use Queueable;

    private $curriculo;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Curriculo $curriculo)
    {
        $this->curriculo = $curriculo;
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
        return (new MailMessage)
            ->line('Você cadastrou um currículo no nosso site com as informações: ')
            ->line($this->curriculo->name)
            ->line($this->curriculo->last_name)
            ->line($this->curriculo->email)
            ->line($this->curriculo->phone)
            ->line($this->curriculo->deseridjob)
            ->line($this->curriculo->schooling)
            ->line($this->curriculo->comments)
            ->line($this->curriculo->file);
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
