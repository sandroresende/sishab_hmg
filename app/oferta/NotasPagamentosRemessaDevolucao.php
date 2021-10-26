<?php

namespace App\oferta;

use Illuminate\Database\Eloquent\Model;

class NotasPagamentosRemessaDevolucao extends Model
{
    protected $connection	= 'pgsql_bv';
    
    protected $table = 'view_notas_pagamento_remessa_devolucao';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
