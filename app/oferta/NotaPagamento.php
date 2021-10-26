<?php

namespace App\oferta;

use Illuminate\Database\Eloquent\Model;

class NotaPagamento extends Model
{
    protected $connection	= 'pgsql_bv';
    
    protected $table = 'tab_notas_pagamento';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function pagamentosContratos()
    {
       return $this->hasMany(PagamentosContrato::class); //possui muitos
    }
}
