<?php

namespace App\oferta;

use Illuminate\Database\Eloquent\Model;

class PagamentosParcelasRemessaDevolucao extends Model
{
    protected $connection	= 'pgsql_bv';
    
    protected $table = 'view_pagamento_parcelas_remessas_devolucao';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
