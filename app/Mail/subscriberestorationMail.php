<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class subscriberestorationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $restorationDetails;

    /**
     * Create a new message instance.
     *
     * @param array $restorationDetails
     *
     * @return void
     */
    public function __construct($restorationDetails)
    {
        $this->restorationDetails = $restorationDetails;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Subscribe Cancellation Mail')
            ->view('emails.subscription.Restoration_Mail');
    }
}
