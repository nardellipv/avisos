<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RejectServiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $service;
    public $motive;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($service, $motive)
    {
        $this->service = $service;
        $this->motive = $motive;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-responder@avisosmendoza.com.ar')
            ->subject('Contacto desde Avisos Mendoza')
            ->view('emails.rejectServiceMail');
    }
}
