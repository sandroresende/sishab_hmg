<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AceiteAdesaoParceria extends Mailable
{
    use Queueable, SerializesModels;

    public $url;
    public $urlProtocolo;
    public $dadosParceria;
    public $municipiosBeneficiados;
    public $entePublicoParcerias;
    public $municipio;
    public $estado;

    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dadosParceria, $municipiosBeneficiados, $entePublicoParcerias,$municipio,$estado)
    {
        $this->url = url('/pcva_parcerias/validacao/filtro');
        $this->urlProtocolo = url('/pcva_parcerias/protocolo/termo/'.$dadosParceria->txt_protocolo_aceite);
        $this->dadosParceria = $dadosParceria;
        $this->municipiosBeneficiados = $municipiosBeneficiados;
        $this->entePublicoParcerias = $entePublicoParcerias;
        $this->municipio = $municipio;
        $this->estado = $estado;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.pcva_parcerias.aceite_termo_parceria');
    }
}
