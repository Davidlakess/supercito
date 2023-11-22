<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class verificarCorreo extends Mailable
{
    use Queueable, SerializesModels;

     public $verificar_email;
 
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($verificar_email)
    {
        $this->verificar_email = $verificar_email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
     
     return $this->from($address = env('MAIL_USERNAME'), $name = 'Supercito')
                    ->view('emails/verificar_correo')
                    ->subject('Datos de Acceso');
    }
}
