<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SolicitudVerif extends Mailable
{
    use Queueable, SerializesModels;

    public $msj;

    /**
     * Create a new message instance.
     */
    public function __construct($msj)
    {
        $this->msj = $msj;
    }

    public function build()
    {
        return $this->subject('Solicitud de verificación')->html($this->msj);
    }
}
