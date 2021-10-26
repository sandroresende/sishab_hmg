<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NovoUsuario extends Mailable
{
    use Queueable, SerializesModels;

    public $url;
    public $usuario;
    public $permissao;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($usuario, $permissao)
    {
        $this->url = url('admin/permissoes/prototipos');
        $this->usuario = $usuario;
        $this->permissao = $permissao;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.prototipo.novo_usuario');
    }
}
