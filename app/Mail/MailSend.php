<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailSend extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $interaction;
    public $for;
    public $sender;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $interaction, $for)
    {
        $sender = auth()->user();

        $this->data = $data;
        $this->interaction = $interaction;
        $this->for = $for;
        $this->sender = $sender;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: new Address($this->sender->email, $this->sender->name),
            subject: $this->data["subject"],
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
            markdown: 'Mail.' . $this->data["header"] . "." . $this->data["action"],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
