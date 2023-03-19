<?php

namespace App\Mail;

use App\Models\Curriculo;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CurriculoMail extends Mailable
{
    use Queueable, SerializesModels;
    /**
     *The order instance.
     *
     */
    protected $curriculo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Curriculo $curriculo)
    {
        $this->curriculo = $curriculo;
    }


    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: new Address(config('mail.from.address'), 'Gabriel Tavares'),
            subject: 'Currículo enviado com sucesso!',
            to: config('mail.from.address'),

        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'contact.message',
            with: [
                'name' => $this->curriculo->name,
                'last_name' => $this->curriculo->last_name,
                'phone' => $this->curriculo->phone,
                'email' => $this->curriculo->email,
                'desiredjob' => $this->curriculo->desiredjob,
                'schooling' => $this->curriculo->schooling,
                'comments' => $this->curriculo->comments,
                'user_ip' => $this->curriculo->user_ip,
                'date_send' => $this->curriculo->date_send,
                'hour_send' => $this->curriculo->hour_send,
                'file' => $this->curriculo->file,

            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [
            Attachment::fromStorage($this->curriculo->path)
                ->as($this->curriculo->name .  ' -Curriculo.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
