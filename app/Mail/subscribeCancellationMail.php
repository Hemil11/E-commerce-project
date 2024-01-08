<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscribeCancellationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $cancellationDetails;

    /**
     * Create a new message instance.
     *
     * @param array $cancellationDetails
     *
     * @return void
     */
    public function __construct($cancellationDetails)
    {
        $this->cancellationDetails = $cancellationDetails;
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
            ->view('emails.subscription.Cancellation_Mail');
    }
}
