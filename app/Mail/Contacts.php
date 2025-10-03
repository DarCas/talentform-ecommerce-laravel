<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Contacts extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        protected readonly string $fullname,
        protected readonly string $email,
        protected readonly ?string $telefono,
        protected readonly string $messaggio,
        protected readonly ?string $product,
    )
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(config('mail.from.address'), config('mail.from.name')),
            replyTo: [
                new Address($this->email, $this->fullname)
            ],
            subject: 'Contatto da ' . config('app.name'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.contacts',
            with: [
                'product' => $this->product,
                'fullname' => $this->fullname,
                'email' => $this->email,
                'telefono' => $this->telefono,
                'messaggio' => $this->messaggio,
            ]
        );
    }
}
