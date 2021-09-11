<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RepublishServiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $service;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($service)
    {
        $this->service = $service;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-responder@avisosmendoza.com.ar')
            ->subject('Se republicó tu servicio')
            ->view('emails.republishServiceMail');
    }
}
