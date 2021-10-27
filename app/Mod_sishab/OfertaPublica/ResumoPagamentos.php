<?php

namespace App\Mod_sishab\OfertaPublica;

use Illuminate\Database\Eloquent\Model;

class ResumoPagamentos extends Model
{
    protected $connection	= 'pgsql_bv';
    
    protected $table = 'view_resumo_pagamento';

    public function resumoContratosProtocolo()
    {
       return $this->belongsTo(ResumoContratosProtocolo::class,'contrato_id', 'contrato_id' ); //possui muitos
    }
    

    
}
