<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PermissaoDeferida extends Mailable
{
    use Queueable, SerializesModels;

    public $url;
    public $permissao;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($permissao)
    {
        $this->url = url('/prototipo');
        $this->permissao = $permissao;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.prototipo.permissao_deferida');
    }
}
