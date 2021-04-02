<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Gmail extends Mailable
{
    use Queueable, SerializesModels;
    public $details;
    public $name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details, $name)
    {
        $this->details = $details;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Renew the Domain and Hosting Service')
            ->view('emails.domain_renewal');
    }
}