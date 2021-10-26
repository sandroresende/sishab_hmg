<?php

namespace App\oferta;

use Illuminate\Database\Eloquent\Model;

class ResumoContratosProtocolo extends Model
{
    protected $connection	= 'pgsql_bv';
    
    protected $table = 'view_resumo_contratos_protocolo';

    public function resumoPagamento()
    {
       return $this->belongsTo(ResumoPagamentos::class,'contrato_id', 'contrato_id' ); //possui muitos
    }
}
