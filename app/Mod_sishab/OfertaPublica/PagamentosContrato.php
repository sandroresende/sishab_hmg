<?php

namespace App\Mod_sishab\OfertaPublica;

use Illuminate\Database\Eloquent\Model;

class PagamentosContrato extends Model
{
    protected $connection	= 'pgsql_bv';
    
    protected $table = 'tab_pagamentos_contrato';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function notaPagamento()
    {
       return $this->belongsTo(NotaPagamento::class,'notas_pagamento_id','id'); //possui muitos
    }
}
