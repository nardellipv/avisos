<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $service;
    public $days;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($service, $days)
    {
        $this->service = $service;
        $this->days = $days;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-responder@avisosmendoza.com.ar')
            ->subject('Destacar Servicio')
            ->view('emails.paymentMail');
    }
}
