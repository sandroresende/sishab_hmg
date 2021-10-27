<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ArquivoTermoEnviado extends Mailable
{
    use Queueable, SerializesModels;

    public $url;
    public $dadosAdesao;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dadosAdesao)
    {
        $this->url = url('/pcva_parcerias/termo/consultar');
        $this->dadosAdesao = $dadosAdesao;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.pcva_parcerias.envio_arquivo_termo');
    }
}
