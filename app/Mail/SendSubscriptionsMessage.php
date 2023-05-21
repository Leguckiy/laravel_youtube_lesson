<?php

namespace App\Mail;

use App\Models\Sku;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendSubscriptionsMessage extends Mailable
{
    use Queueable, SerializesModels;

    protected $sku;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Sku $sku)
    {
        $this->sku = $sku;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Send Subscriptions Message',
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
            view: 'mail.subscription',
            with: [
                'sku' => $this->sku,
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
        return [];
    }
}
