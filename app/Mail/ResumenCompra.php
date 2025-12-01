<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResumenCompra extends Mailable
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
        return $this->subject('Resumen compra')->html($this->msj);
    }
}
