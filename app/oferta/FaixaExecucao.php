<?php

namespace App\oferta;

use Illuminate\Database\Eloquent\Model;

class FaixaExecucao extends Model
{
    
    protected $connection	= 'pgsql_bv';
    
    protected $table = 'view_faixa_execucao';

    public function resumoContratosProtocolo()
    {
       return $this->belongsTo(ResumoContratosProtocolo::class,'contrato_id', 'contrato_id' ); //possui muitos
    }
    

    
}
