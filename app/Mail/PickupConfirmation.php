<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PickupConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $pickup;
    /**
     * Pass the Pickup instance to the email.
     *
     * @param $pickup
     */
    public function __construct($pickup)
    {
        $this->pickup = $pickup;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pickup Confirmation',  // Set the email subject
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.pickup_confirmation',
            with: [
                'pickup' => $this->pickup,
                'token' => $this->pickup->verification_token,  // Include token
                'acceptUrl' => route('pickup.confirm', [
                    'id' => $this->pickup->id,
                    'action' => 'accept',
                    'token' => $this->pickup->verification_token,  // Send token
                ]),
                'rejectUrl' => route('pickup.confirm', [
                    'id' => $this->pickup->id,
                    'action' => 'reject',
                    'token' => $this->pickup->verification_token,  // Send token
                ]),
            ]
        );
    }


    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
