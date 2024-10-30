<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RecordatorioPago extends Mailable
{
    use Queueable, SerializesModels;

    public $cliente;

    /**
     * Create a new message instance.
     *
     * @param $cliente
     */
    public function __construct($cliente)
    {
        $this->cliente = $cliente;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Recordatorio de Pago')
                    ->view('emails.recordatorio_pago'); 
    }
}
